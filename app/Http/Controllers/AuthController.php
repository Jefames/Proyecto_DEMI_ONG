<?php

namespace App\Http\Controllers;

use App\Models\Department;
use App\Models\ServiceType;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public  function index(){
        $users = User::all();
        return view('users.index', ['usuarios' => $users]);
    }
    public function create()
    {
        $departamentos = Department::all();
        $tipos_servicio = ServiceType::all();

        return view('users.create', compact('departamentos', 'tipos_servicio'));
    }
    public function register(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'cod_user' => 'required|unique:users',
            'password' => 'required|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'cod_user' => $request->cod_user,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json($user);
    }

    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'cod_user' => 'required',
                'password' => 'required',
            ]);
    
            if (Auth::attempt(['cod_user' => $request->cod_user, 'password' => $request->password])) {
                // Autenticación exitosa, guardar mensaje de éxito en la sesión
                session()->flash('success', '¡Bienvenido(a) de nuevo, '.Auth::user()->name.'!');
            } else {
                // Autenticación fallida, guardar mensaje de error en la sesión
                session()->flash('error', 'Código o contraseña incorrectos');
            }
        } catch (ValidationException $ex) {
            // Si hay errores de validación, devuelve una respuesta JSON con los errores
            return response()->json(['message' => $ex->errors()], 422);
        } catch (\Exception $ex) {
            // Si ocurre otro tipo de excepción, devuelve un error general
            return response()->json(['message' => 'Error de autenticación desconocido'], 500);
        }
    
        // Redirige siempre a la página principal
        return redirect('/');
    }

    //GUARDAR USUARIO
    public function store(Request $request)
    {

        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'unique:users,email',
            'password' => 'required',
            'rol' => 'required',
            'departamento_id' => 'required|exists:departments,id',
            'tipo_servicio_id' => 'required|exists:service_types,id',
            'tipo_atencion_sede' => 'nullable|string' // Campo opcional y puede ser nulo o una cadena
        ]);

        $user = new User();
        $user->name = $request->nombre;
        $user->apellidos = $request->apellido;
        if (!is_null($request->email)){
            $user->email = $request->email;
        }
        $user->password = bcrypt($request->password); // Encripta la contraseña
        $user->departamento_id = $request->departamento_id;
        $user->tipo_servicio_id = $request->tipo_servicio_id;
        $user->rol = $request->rol;

        // Busca el tipo de servicio para obtener el código de servicio
        $tipoServicio = ServiceType::find($request->tipo_servicio_id);

        $tipoSede = '';
        // Asegúrate de que el tipo de sede existe
        if (isset($request->tipo_atencion_sede)) {
            $tipoSede = $request->tipo_atencion_sede;
        }

        // Generar el código del usuario
        $codigoDepartamento = sprintf('%02d', $user->departamento_id);
        $codigoServicio = $tipoServicio->cod_service; // Aquí obtienes el código del tipo de servicio
        $idUsuario = User::max('id') + 1; // Obtiene el próximo ID de usuario

        $user->cod_user = $codigoDepartamento . $codigoServicio . sprintf('%02d', $idUsuario) . $tipoSede;

        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario creado con éxito.');
    }

    public function edit($id)
    {
        $usuario = User::findOrFail($id);
        $departamentos = Department::all();
        $tipos_servicio = ServiceType::all();
        //Validar el tamaño del campo cod_user, si tiene 10 caracteres es porque tiene el tipo de atención
        $tipo_atencion = strlen($usuario->cod_user) == 10 ? substr($usuario->cod_user, -4) : "";

        // Aquí puedes pasar cualquier otra información necesaria para la vista
        return view('users.edit', compact('usuario','departamentos','tipos_servicio', 'tipo_atencion'));
    }

    //GUARDAR EDICION DEL USUARIO
    public function update(Request $request, $id)
    {

        // Valida los otros campos aquí...
        $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'email' => 'unique:users,email,' . $id,
            'password' => 'nullable',
            'rol' => 'required',
            'departamento_id' => 'required|exists:departments,id',
            'tipo_servicio_id' => 'required|exists:service_types,id',
        ]);

        $user = User::findOrFail($id);

        $user->name = $request->nombre;
        $user->apellidos = $request->apellido;

        if (!is_null($request->email)){
            $user->email = $request->email;
        }
        // Actualizar la contraseña solo si se proporcionó una nueva
        if (!empty($request->password)) {
            $user->password = Hash::make($request->password);
        }

        $user->departamento_id = $request->departamento_id;
        $user->tipo_servicio_id = $request->tipo_servicio_id;
        $user->rol = $request->rol;

        // Busca el tipo de servicio para obtener el código de servicio
        $tipoServicio = ServiceType::find($request->tipo_servicio_id);

        // Generar el código del usuario
        $codigoDepartamento = sprintf('%02d', $user->departamento_id);
        $codigoServicio = $tipoServicio->cod_service; // Aquí obtienes el código del tipo de servicio
        $idUsuario = $id;

        $tipoSede = '';
        // Asegúrate de que el tipo de sede existe
        if (isset($request->tipo_atencion_sede)) {
            $tipoSede = $request->tipo_atencion_sede;
        }

        $user->cod_user = $codigoDepartamento . $codigoServicio . sprintf('%02d', $idUsuario) . $tipoSede;


        // Guardar los cambios
        $user->save();

        return redirect()->route('users.index')->with('success', 'Usuario editado con éxito.');

    }


    //CERRAR SESION
    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('login')->with('success','¡Has cerrado sesión con exito!');
    }

    //DESACTIVAR USUARIO
    public function inactivar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = false; // Asumiendo que tienes un campo 'activo' en tu modelo
        $usuario->save();

        return redirect()->route('users.index')->with('success', 'Usuario desactivado con éxito');
    }

    //ACTIVAR USUARIO
    public function activar($id)
    {
        $usuario = User::findOrFail($id);
        $usuario->estado = true;
        $usuario->save();

        return redirect()->route('users.index')->with('success', 'Usuario activado con éxito');
    }

}

