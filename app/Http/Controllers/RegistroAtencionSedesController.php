<?php

namespace App\Http\Controllers;

use App\Models\ComunidadLinguistica;
use App\Models\CoordinacionInterinstitucional;
use App\Models\Department;
use App\Models\escolaridad;
use App\Models\idioma;
use App\Models\municipio;
use App\Models\Pueblo;
use App\Models\puebloper;
use App\Models\Registro_Atencion_Sedes;
use App\Models\ServiceType;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\RegistersEventListeners;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Events\BeforeSheet;
use Maatwebsite\Excel\Facades\Excel;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\Log;

class RegistroAtencionSedesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $expedientesRAS = Registro_Atencion_Sedes::all();
        return view('services.atencion_sedes.index', ['expedientes' => $expedientesRAS]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $escolaridades = escolaridad::all();
        $idiomas = idioma::all();
        $comlings = ComunidadLinguistica::all();
        $pueblopers = Pueblo::all();
        $departamentos = Department::all();
        $municipios = municipio::all();
        return view('services.atencion_sedes.create', compact('departamentos', 'escolaridades', 'idiomas', 'comlings', 'pueblopers', 'municipios'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $id_user = Auth::id();
        $user = Auth::user();

        Log::channel('debbug')->info('Request:');
        Log::channel('debbug')->info($request);
        $validatedData = $request->validate([
            // Primera pestaña
            'no_exp'                            => 'required|integer|max:50|unique:registro_atencion_sedes,no_exp',
            'fecha'                             => 'required|date',
            'hora_exp'                          => 'required|date_format:H:i',
            'fecha_pa'                          => 'required|date',

            // Segunda pestaña
            'nombre'                            => 'required|string|max:50',
            'seg_nombre'                        => 'nullable|string|max:50',
            'ter_nombre'                        => 'nullable|string|max:50',
            'apellido'                          => 'required|string|max:50',
            'apellido2'                         => 'nullable|string|max:50',
            'apellido_cas'                      => 'nullable|string|max:50',
            'fecha_nac'                         => 'required|date',
            'edad'                              => 'nullable|integer|max:15',
            'sexo'                              => 'required|string|max:15',
            'nacionalidad'                      => 'string|max:50',
            'estado_civil'                      => 'string|max:50',
            'escolaridad'                       => 'required|integer|exists:escolaridad,id',
            'pueblo'                            => 'required|integer|exists:pueblos,id',
            'comunidad_linguistica'             => 'required|integer|exists:comunidad_linguistica,id',
            'religion'                          => 'string|max:50',
            'discapacidad'                      => 'nullable|string|max:50',
            'hijos'                             => 'integer',
            'hijas'                             => 'integer',
            'direccion_casa'                    => 'string|max:100',
            'tel_casaa'                         => 'nullable|string|max:15',
            'tel_movil'                         => 'nullable|string|max:15',
            'tel_referencia'                    => 'nullable|string|max:15',
            'nac_department_id'                 => 'required|integer|exists:departments,id',
            'nac_muni_id'                       => 'required|integer|exists:municipios,id',
            'trabaja'                           => 'required|integer',
            'profesion'                         => 'nullable|string|max:50',

            //Tercera pestaña
            'ide_necesidades'                   => 'string|max:100',
            'inf_servicios'                     => 'string|max:100',
            'riesgos'                           => 'string|max:100',
            'especificacion_riesgo_violencia'   => 'string|max:100',
            'persona_violencia'                 => 'string|max:100',
            'frecuencia_violencia'              => 'string|max:100',
            'antecedentes_acciones'             => 'string|max:100',
            'motivos_consulta'                  => 'string|max:100',
            'atencion_referencia'               => 'string|max:100',
        ]);

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1347') || $user->rol == 'Administrador') {
            $camposValidacionCuartaPestana = $request->validate([
                //Cuarta pestaña
                'estado_expediente'                 => 'array',
                'acciones_desarrolladas'            => 'string|max:50',
                'referida_a'                        => 'string|max:100',
                'observaciones_unidad_social'       => 'string|max:100',
            ]);
        }

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1348') || $user->rol == 'Administrador') {
            $camposValidacionQuintaPestana = $request->validate([
                //Quinta pestaña
                'estado_expediente_unidad_juridica' => 'array',
                'tipologia'                         => 'array',
                'familia'                           => 'nullable|array',
                'recepcion_documentos'              => 'nullable|string|max:100',
                'redaccion_demanda'                 => 'nullable|string|max:100',
                'firma_demanda'                     => 'nullable|string|max:100',
                'ingreso_demanda'                   => 'nullable|string|max:100',
                'recepcion_demanda'                 => 'nullable|string|max:100',
                'redaccion_demanda'                 => 'nullable|string|max:100',
                'fechas_audiencia'                  => 'nullable|array',
                'redaccion_memoriales'              => 'nullable|string',
                'conclusion_proceso'                => 'nullable|string',
                'referida_juridica'                 => 'nullable|string|max:100',
                'observaciones_juridica'            => 'nullable|string|max:1500',
            ]);
        }

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1349') || $user->rol == 'Administrador') {
            $camposValidacionQuintaPestana = $request->validate([
                //Quinta pestaña
                'estado_expediente_unidad_psicologica'          => 'nullable|array',
                'atencion_psicologica_recibida'                 => 'nullable|string',
                'lugar_atencion_psicologica_recibida'           => 'nullable|string',
                'tipo_atencion_brindada'                        => 'nullable|string|max:100',
                'fechas_atencion_recibidas'                     => 'nullable|array',
                'tipos_violencia'                               => 'nullable|array',
                'sesiones_atencion'                             => 'nullable|array',
                'fechas_atencion'                               => 'nullable|array',
                'diagnostico_atencion'                          => 'nullable|string|max:1500',
                'evaluacion_atencion'                           => 'nullable|string|max:1500',
                'orientacion_psicologica'                       => 'nullable|array',
                'sesiones_orientacion'                          => 'nullable|array',
                'fechas_orientacion'                            => 'nullable|array',
                'diagnostico_orientacion'                       => 'nullable|string|max:1500',
                'referida_a_unidad_psicologica'                 => 'nullable|string|max:100',
                'observaciones_unidad_psicologica'              => 'nullable|string|max:1500',
            ]);
        }

        // Crear una nueva instancia de tu modelo y setear los valores
        $registroAtencionSede = new Registro_Atencion_Sedes;

        // Primera pestaña
        $registroAtencionSede->no_exp       = $validatedData['no_exp'];
        $registroAtencionSede->fecha_exp    = $validatedData['fecha'];
        $registroAtencionSede->hora_exp     = date('H:i:s', strtotime($validatedData['hora_exp']));
        $registroAtencionSede->fecha_pa     = $validatedData['fecha_pa'];

        // Segunda pestaña
        $registroAtencionSede->nombre                   = $validatedData['nombre'];
        $registroAtencionSede->seg_nombre               = $validatedData['seg_nombre'] ?? null;
        $registroAtencionSede->ter_nombre               = $validatedData['ter_nombre'] ?? null;
        $registroAtencionSede->apellido                 = $validatedData['apellido'];
        $registroAtencionSede->apellido2                = $validatedData['apellido2'] ?? null;
        $registroAtencionSede->apellido_cas             = $validatedData['apellido_cas'] ?? null;
        $registroAtencionSede->fecha_nac                = $validatedData['fecha_nac'] ?? null;
        $registroAtencionSede->edad                     = $validatedData['edad'] ?? null;
        $registroAtencionSede->sexo                     = $validatedData['sexo'] ?? null;
        $registroAtencionSede->nacionalidad             = $validatedData['nacionalidad'];
        $registroAtencionSede->estado_civil             = $validatedData['estado_civil'];
        $registroAtencionSede->escolaridad              = $validatedData['escolaridad'];
        $registroAtencionSede->pueblo                   = $validatedData['pueblo'];
        $registroAtencionSede->comunidad_linguistica    = $validatedData['comunidad_linguistica'];
        $registroAtencionSede->religion                 = $validatedData['religion'] ?? null;
        $registroAtencionSede->discapacidad             = $validatedData['discapacidad'] ?? null;
        $registroAtencionSede->hijos                    = $validatedData['hijos'] ?? null;
        $registroAtencionSede->hijas                    = $validatedData['hijas'] ?? null;
        $registroAtencionSede->direccion_casa           = $validatedData['direccion_casa'] ?? null;
        $registroAtencionSede->tel_casaa                = $validatedData['tel_casaa'] ?? null;
        $registroAtencionSede->tel_movil                = $validatedData['tel_movil'] ?? null;
        $registroAtencionSede->tel_referencia           = $validatedData['tel_referencia'] ?? null;
        $registroAtencionSede->nac_department_id        = $validatedData['nac_department_id'];
        $registroAtencionSede->nac_muni_id              = $validatedData['nac_muni_id'];
        $registroAtencionSede->ocupacion                = $validatedData['profesion'];
        if ($validatedData['trabaja'] == '1') {
            $registroAtencionSede->trabaja = 1;
        } else {
            $registroAtencionSede->trabaja = 2;
        }

        //Tercera pestaña
        $registroAtencionSede->identificacion_necesidades   = $validatedData['ide_necesidades'];
        $registroAtencionSede->servicios_brindados          = $validatedData['inf_servicios'];
        $registroAtencionSede->riesgo_violencia             = $validatedData['riesgos'];
        $registroAtencionSede->especificacion_riesgo        = $validatedData['especificacion_riesgo_violencia'];
        $registroAtencionSede->agresor                      = $validatedData['persona_violencia'];
        $registroAtencionSede->frecuencia_eventos           = $validatedData['frecuencia_violencia'];
        $registroAtencionSede->historial_acciones_usuario   = $validatedData['antecedentes_acciones'];
        $registroAtencionSede->motivo_consulta              = $validatedData['motivos_consulta'];
        $registroAtencionSede->tipo_atencion                = $validatedData['atencion_referencia'];

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1347') || $user->rol == 'Administrador') {
            // Cuarta pestaña
            $registroAtencionSede->estado_expediente            = $camposValidacionCuartaPestana['estado_expediente'][0] ?? null;
            $registroAtencionSede->acciones_desarrolladas       = $camposValidacionCuartaPestana['acciones_desarrolladas'];
            $registroAtencionSede->referida_a                   = $camposValidacionCuartaPestana['referida_a'];
            $registroAtencionSede->observaciones_unidad_social  = $camposValidacionCuartaPestana['observaciones_unidad_social'];
        }

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1348') || $user->rol == 'Administrador') {
            // Quinta pestaña
            $registroAtencionSede->estado_expediente_unidad_juridica    = $camposValidacionQuintaPestana['estado_expediente_unidad_juridica'][0] ?? null;
            $registroAtencionSede->tipologia                            = $camposValidacionQuintaPestana['tipologia'][0] ?? null;
            $registroAtencionSede->familia                              = $camposValidacionQuintaPestana['familia'][0] ?? null;
            $registroAtencionSede->recepcion_documentos                 = $camposValidacionQuintaPestana['recepcion_documentos'];
            $registroAtencionSede->redaccion_demanda                    = $camposValidacionQuintaPestana['redaccion_demanda'];
            $registroAtencionSede->firma_demanda                        = $camposValidacionQuintaPestana['firma_demanda'];
            $registroAtencionSede->ingreso_demanda                      = $camposValidacionQuintaPestana['ingreso_demanda'];
            $registroAtencionSede->recepcion_demanda                    = $camposValidacionQuintaPestana['recepcion_demanda'];
            $registroAtencionSede->fechas_audiencia                     = implode(',', $camposValidacionQuintaPestana['fechas_audiencia']);
            $registroAtencionSede->redaccion_otros_memoriales           = $camposValidacionQuintaPestana['redaccion_memoriales'];
            $registroAtencionSede->conclusion_este_proceso              = $camposValidacionQuintaPestana['conclusion_proceso'];
            $registroAtencionSede->referida_a_unidad_juridica           = $camposValidacionQuintaPestana['referida_juridica'];
            $registroAtencionSede->observaciones_unidad_juridica        = $camposValidacionQuintaPestana['observaciones_juridica'];
        }

        // $registroAtencionSede->trabaja = $validatedData['trabaja'] == 'Si';
        Log::channel('debbug')->info('Escolaridad:');
        Log::channel('debbug')->info($validatedData['escolaridad']);

        
        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1349') || $user->rol == 'Administrador') {
            // Quinta pestaña
            $registroAtencionSede->estado_expediente_unidad_psicologica = $camposValidacionQuintaPestana['estado_expediente_unidad_psicologica'][0] ?? null;
            $registroAtencionSede->atencion_psicologica_recibida        = $camposValidacionQuintaPestana['atencion_psicologica_recibida'];
            $registroAtencionSede->lugar_atencion_psicologica_recibida  = $camposValidacionQuintaPestana['lugar_atencion_psicologica_recibida'];
            $registroAtencionSede->tipo_atencion_brindada               = $camposValidacionQuintaPestana['tipo_atencion_brindada'];
            $registroAtencionSede->fechas_atencion_recibidas            = implode(',', $camposValidacionQuintaPestana['fechas_atencion_recibidas']);
            $registroAtencionSede->tipos_violencia                      = $camposValidacionQuintaPestana['tipos_violencia'][0] ?? null;
            $sesiones_atencion = $camposValidacionQuintaPestana['sesiones_atencion'];
            $fechas_atencion = $camposValidacionQuintaPestana['fechas_atencion'];
            $sesiones_atencion_fechas = [];
            for ($i = 0; $i < count($sesiones_atencion); $i++) {
                $sesiones_atencion_fechas[] = [$sesiones_atencion[$i], $fechas_atencion[$i]];
            }
            $registroAtencionSede->sesion_atencion                   = json_encode($sesiones_atencion_fechas);
            $registroAtencionSede->diagnostico_atencion                = $camposValidacionQuintaPestana['diagnostico_atencion'];
            $registroAtencionSede->evaluacion_atencion                 = $camposValidacionQuintaPestana['evaluacion_atencion'];
            $registroAtencionSede->orientacion_psicologica             = $camposValidacionQuintaPestana['orientacion_psicologica'][0] ?? null;
            $sesiones_orientacion = $camposValidacionQuintaPestana['sesiones_orientacion'];
            $fechas_orientacion = $camposValidacionQuintaPestana['fechas_orientacion'];
            $sesiones_orientacion_fechas = [];
            for ($i = 0; $i < count($sesiones_orientacion); $i++) {
                $sesiones_orientacion_fechas[] = [$sesiones_orientacion[$i], $fechas_orientacion[$i]];
            }
            $registroAtencionSede->sesion_orientacion                = json_encode($sesiones_orientacion_fechas);
            $registroAtencionSede->diagnostico_orientacion             = $camposValidacionQuintaPestana['diagnostico_orientacion'];
            $registroAtencionSede->referida_a_unidad_psicologica       = $camposValidacionQuintaPestana['referida_a_unidad_psicologica'];
            $registroAtencionSede->observaciones_unidad_psicologica    = $camposValidacionQuintaPestana['observaciones_unidad_psicologica'];
        }

        $tipo_servicio = ServiceType::where('cod_service', '03')->first();
        $registroAtencionSede->tipo_servicio_id = $tipo_servicio->id;

        $registroAtencionSede->user_creator_id = $id_user;

        // Guardar el registro en la base de datos
        $registroAtencionSede->save();

        // Devolver una respuesta
        return redirect()->route('registro_sedes.index')->with('success', 'Expediente creado y guardado con éxito!');

    }

    /**
     * Display the specified resource.
     */

    public  function show($id_expediente){
        $expediente = Registro_Atencion_Sedes::find($id_expediente);
        //   $expedientesCall = CallCenter::all();
        return view('services.atencion_sedes.show',compact('expediente'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id_registro)
    {   
        $registro = Registro_Atencion_Sedes::find($id_registro);
        $escolaridades = escolaridad::all();
        $idiomas = idioma::all();
        $comlings = ComunidadLinguistica::all();
        $pueblopers = Pueblo::all();
        $departamentos = Department::all();
        $municipios = municipio::all();
        return view('services.atencion_sedes.edit', compact('departamentos', 'escolaridades', 'idiomas', 'comlings', 'pueblopers', 'municipios', 'registro'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id_registro)
    {
        $id_user = Auth::id();
        $user = Auth::user();

        Log::channel('debbug')->info('Request:');
        Log::channel('debbug')->info($request);
        Log::channel('debbug')->info('ID Registro:');
        Log::channel('debbug')->info($id_registro);
        $validatedData = $request->validate([
            // Primera pestaña
            'fecha'                             => 'required|date',
            'hora_exp'                          => 'required|date_format:H:i:s',
            'fecha_pa'                          => 'required|date',

            // Segunda pestaña
            'nombre'                            => 'required|string|max:50',
            'seg_nombre'                        => 'nullable|string|max:50',
            'ter_nombre'                        => 'nullable|string|max:50',
            'apellido'                          => 'required|string|max:50',
            'apellido2'                         => 'nullable|string|max:50',
            'apellido_cas'                      => 'nullable|string|max:50',
            'fecha_nac'                         => 'required|date',
            'edad'                              => 'nullable|integer|max:15',
            'sexo'                              => 'required|string|max:15',
            'nacionalidad'                      => 'string|max:50',
            'estado_civil'                      => 'string|max:50',
            'escolaridad'                       => 'required|integer|exists:escolaridad,id',
            'pueblo'                            => 'required|integer|exists:pueblos,id',
            'comunidad_linguistica'             => 'required|integer|exists:comunidad_linguistica,id',
            'religion'                          => 'string|max:50',
            'discapacidad'                      => 'nullable|string|max:50',
            'hijos'                             => 'integer',
            'hijas'                             => 'integer',
            'direccion_casa'                    => 'string|max:100',
            'tel_casaa'                         => 'nullable|string|max:15',
            'tel_movil'                         => 'nullable|string|max:15',
            'tel_referencia'                    => 'nullable|string|max:15',
            'nac_department_id'                 => 'required|integer|exists:departments,id',
            'nac_muni_id'                       => 'required|integer|exists:municipios,id',
            'trabaja'                           => 'required|integer',
            'profesion'                         => 'nullable|string|max:50',

            //Tercera pestaña
            'ide_necesidades'                   => 'string|max:100',
            'inf_servicios'                     => 'string|max:100',
            'riesgos'                           => 'string|max:100',
            'especificacion_riesgo_violencia'   => 'string|max:100',
            'persona_violencia'                 => 'string|max:100',
            'frecuencia_violencia'              => 'string|max:100',
            'antecedentes_acciones'             => 'string|max:100',
            'motivos_consulta'                  => 'string|max:100',
            'atencion_referencia'               => 'string|max:100',
        ]);

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1347') || $user->rol == 'Administrador') {
            $camposValidacionCuartaPestana = $request->validate([
                //Cuarta pestaña
                'estado_expediente'                 => 'array',
                'acciones_desarrolladas'            => 'string|max:50',
                'referida_a'                        => 'string|max:100',
                'observaciones_unidad_social'       => 'string|max:100',
            ]);
        }

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1348') || $user->rol == 'Administrador') {
            $camposValidacionQuintaPestana = $request->validate([
                //Quinta pestaña
                'estado_expediente_unidad_juridica' => 'array',
                'tipologia'                         => 'array',
                'familia'                           => 'nullable|array',
                'recepcion_documentos'              => 'nullable|string|max:100',
                'redaccion_demanda'                 => 'nullable|string|max:100',
                'firma_demanda'                     => 'nullable|string|max:100',
                'ingreso_demanda'                   => 'nullable|string|max:100',
                'recepcion_demanda'                 => 'nullable|string|max:100',
                'redaccion_demanda'                 => 'nullable|string|max:100',
                'fechas_audiencia'                  => 'nullable|array',
                'redaccion_memoriales'              => 'nullable|string',
                'conclusion_proceso'                => 'nullable|string',
                'referida_juridica'                 => 'nullable|string|max:100',
                'observaciones_juridica'            => 'nullable|string|max:1500',
            ]);
        }

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1349') || $user->rol == 'Administrador') {
            $camposValidacionQuintaPestana = $request->validate([
                //Quinta pestaña
                'estado_expediente_unidad_psicologica'          => 'nullable|array',
                'atencion_psicologica_recibida'                 => 'nullable|string',
                'lugar_atencion_psicologica_recibida'           => 'nullable|string',
                'tipo_atencion_brindada'                        => 'nullable|string|max:100',
                'fechas_atencion_recibidas'                     => 'nullable|array',
                'tipos_violencia'                               => 'nullable|array',
                'sesiones_atencion'                             => 'nullable|array',
                'fechas_atencion'                               => 'nullable|array',
                'diagnostico_atencion'                          => 'nullable|string|max:1500',
                'evaluacion_atencion'                           => 'nullable|string|max:1500',
                'orientacion_psicologica'                       => 'nullable|array',
                'sesiones_orientacion'                          => 'nullable|array',
                'fechas_orientacion'                            => 'nullable|array',
                'diagnostico_orientacion'                       => 'nullable|string|max:1500',
                'referida_a_unidad_psicologica'                 => 'nullable|string|max:100',
                'observaciones_unidad_psicologica'              => 'nullable|string|max:1500',
            ]);
        }

        // Crear una nueva instancia de tu modelo y setear los valores
        $registroAtencionSede = Registro_Atencion_Sedes::findOrFail($id_registro);
        Log::channel('debbug')->info('Registro Atención Sede:');
        Log::channel('debbug')->info($registroAtencionSede);

        // Primera pestaña
        $registroAtencionSede->fecha_exp    = $validatedData['fecha'];
        $registroAtencionSede->hora_exp     = date('H:i:s', strtotime($validatedData['hora_exp']));
        $registroAtencionSede->fecha_pa     = $validatedData['fecha_pa'];

        // Segunda pestaña
        $registroAtencionSede->nombre                   = $validatedData['nombre'];
        $registroAtencionSede->seg_nombre               = $validatedData['seg_nombre'] ?? null;
        $registroAtencionSede->ter_nombre               = $validatedData['ter_nombre'] ?? null;
        $registroAtencionSede->apellido                 = $validatedData['apellido'];
        $registroAtencionSede->apellido2                = $validatedData['apellido2'] ?? null;
        $registroAtencionSede->apellido_cas             = $validatedData['apellido_cas'] ?? null;
        $registroAtencionSede->fecha_nac                = $validatedData['fecha_nac'] ?? null;
        $registroAtencionSede->edad                     = $validatedData['edad'] ?? null;
        $registroAtencionSede->sexo                     = $validatedData['sexo'] ?? null;
        $registroAtencionSede->nacionalidad             = $validatedData['nacionalidad'];
        $registroAtencionSede->estado_civil             = $validatedData['estado_civil'];
        $registroAtencionSede->escolaridad              = $validatedData['escolaridad'];
        $registroAtencionSede->pueblo                   = $validatedData['pueblo'];
        $registroAtencionSede->comunidad_linguistica    = $validatedData['comunidad_linguistica'];
        $registroAtencionSede->religion                 = $validatedData['religion'] ?? null;
        $registroAtencionSede->discapacidad             = $validatedData['discapacidad'] ?? null;
        $registroAtencionSede->hijos                    = $validatedData['hijos'] ?? null;
        $registroAtencionSede->hijas                    = $validatedData['hijas'] ?? null;
        $registroAtencionSede->direccion_casa           = $validatedData['direccion_casa'] ?? null;
        $registroAtencionSede->tel_casaa                = $validatedData['tel_casaa'] ?? null;
        $registroAtencionSede->tel_movil                = $validatedData['tel_movil'] ?? null;
        $registroAtencionSede->tel_referencia           = $validatedData['tel_referencia'] ?? null;
        $registroAtencionSede->nac_department_id        = $validatedData['nac_department_id'];
        $registroAtencionSede->nac_muni_id              = $validatedData['nac_muni_id'];
        $registroAtencionSede->ocupacion                = $validatedData['profesion'];
        if ($validatedData['trabaja'] == '1') {
            $registroAtencionSede->trabaja = 1;
        } else {
            $registroAtencionSede->trabaja = 2;
        }

        //Tercera pestaña
        $registroAtencionSede->identificacion_necesidades   = $validatedData['ide_necesidades'];
        $registroAtencionSede->servicios_brindados          = $validatedData['inf_servicios'];
        $registroAtencionSede->riesgo_violencia             = $validatedData['riesgos'];
        $registroAtencionSede->especificacion_riesgo        = $validatedData['especificacion_riesgo_violencia'];
        $registroAtencionSede->agresor                      = $validatedData['persona_violencia'];
        $registroAtencionSede->frecuencia_eventos           = $validatedData['frecuencia_violencia'];
        $registroAtencionSede->historial_acciones_usuario   = $validatedData['antecedentes_acciones'];
        $registroAtencionSede->motivo_consulta              = $validatedData['motivos_consulta'];
        $registroAtencionSede->tipo_atencion                = $validatedData['atencion_referencia'];

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1347') || $user->rol == 'Administrador') {
            // Cuarta pestaña
            $registroAtencionSede->estado_expediente            = $camposValidacionCuartaPestana['estado_expediente'][0] ?? null;
            $registroAtencionSede->acciones_desarrolladas       = $camposValidacionCuartaPestana['acciones_desarrolladas'];
            $registroAtencionSede->referida_a                   = $camposValidacionCuartaPestana['referida_a'];
            $registroAtencionSede->observaciones_unidad_social  = $camposValidacionCuartaPestana['observaciones_unidad_social'];
        }

        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1348') || $user->rol == 'Administrador') {
            // Quinta pestaña
            $registroAtencionSede->estado_expediente_unidad_juridica    = $camposValidacionQuintaPestana['estado_expediente_unidad_juridica'][0] ?? null;
            $registroAtencionSede->tipologia                            = $camposValidacionQuintaPestana['tipologia'][0] ?? null;
            $registroAtencionSede->familia                              = $camposValidacionQuintaPestana['familia'][0] ?? null;
            $registroAtencionSede->recepcion_documentos                 = $camposValidacionQuintaPestana['recepcion_documentos'];
            $registroAtencionSede->redaccion_demanda                    = $camposValidacionQuintaPestana['redaccion_demanda'];
            $registroAtencionSede->firma_demanda                        = $camposValidacionQuintaPestana['firma_demanda'];
            $registroAtencionSede->ingreso_demanda                      = $camposValidacionQuintaPestana['ingreso_demanda'];
            $registroAtencionSede->recepcion_demanda                    = $camposValidacionQuintaPestana['recepcion_demanda'];
            $registroAtencionSede->fechas_audiencia                     = implode(',', $camposValidacionQuintaPestana['fechas_audiencia']);
            $registroAtencionSede->redaccion_otros_memoriales           = $camposValidacionQuintaPestana['redaccion_memoriales'];
            $registroAtencionSede->conclusion_este_proceso              = $camposValidacionQuintaPestana['conclusion_proceso'];
            $registroAtencionSede->referida_a_unidad_juridica           = $camposValidacionQuintaPestana['referida_juridica'];
            $registroAtencionSede->observaciones_unidad_juridica        = $camposValidacionQuintaPestana['observaciones_juridica'];
        }

        // $registroAtencionSede->trabaja = $validatedData['trabaja'] == 'Si';
        Log::channel('debbug')->info('Escolaridad:');
        Log::channel('debbug')->info($validatedData['escolaridad']);

        
        if (($user->tiposervicio->cod_service == '03' && substr($user->cod_user, -4) == '1349') || $user->rol == 'Administrador') {
            // Quinta pestaña
            $registroAtencionSede->estado_expediente_unidad_psicologica = $camposValidacionQuintaPestana['estado_expediente_unidad_psicologica'][0] ?? null;
            $registroAtencionSede->atencion_psicologica_recibida        = $camposValidacionQuintaPestana['atencion_psicologica_recibida'];
            $registroAtencionSede->lugar_atencion_psicologica_recibida  = $camposValidacionQuintaPestana['lugar_atencion_psicologica_recibida'];
            $registroAtencionSede->tipo_atencion_brindada               = $camposValidacionQuintaPestana['tipo_atencion_brindada'];
            $registroAtencionSede->fechas_atencion_recibidas            = implode(',', $camposValidacionQuintaPestana['fechas_atencion_recibidas']);
            $registroAtencionSede->tipos_violencia                      = $camposValidacionQuintaPestana['tipos_violencia'][0] ?? null;
            $sesiones_atencion = $camposValidacionQuintaPestana['sesiones_atencion'] ?? null;
            $fechas_atencion = $camposValidacionQuintaPestana['fechas_atencion'] ?? null;
            $sesiones_atencion_fechas = [];
            if($sesiones_atencion && $fechas_atencion){
                for ($i = 0; $i < count($sesiones_atencion); $i++) {
                    $sesiones_atencion_fechas[] = [$sesiones_atencion[$i], $fechas_atencion[$i]];
                }
                $sesiones_atencion_fechas = json_encode($sesiones_atencion_fechas);
            }
            $registroAtencionSede->sesion_atencion                     = $sesiones_atencion_fechas;
            $registroAtencionSede->diagnostico_atencion                = $camposValidacionQuintaPestana['diagnostico_atencion'] ?? null;
            $registroAtencionSede->evaluacion_atencion                 = $camposValidacionQuintaPestana['evaluacion_atencion'] ?? null;
            $registroAtencionSede->orientacion_psicologica             = $camposValidacionQuintaPestana['orientacion_psicologica'][0] ?? null;
            $sesiones_orientacion = $camposValidacionQuintaPestana['sesiones_orientacion'] ?? null;
            $fechas_orientacion = $camposValidacionQuintaPestana['fechas_orientacion'] ?? null;
            $sesiones_orientacion_fechas = [];
            if($sesiones_orientacion && $fechas_orientacion){
                for ($i = 0; $i < count($sesiones_orientacion); $i++) {
                    $sesiones_orientacion_fechas[] = [$sesiones_orientacion[$i], $fechas_orientacion[$i]];
                }
                $sesiones_orientacion_fechas = json_encode($sesiones_orientacion_fechas);
            }
            $registroAtencionSede->sesion_orientacion                  = $sesiones_orientacion_fechas;
            $registroAtencionSede->diagnostico_orientacion             = $camposValidacionQuintaPestana['diagnostico_orientacion'] ?? null;
            $registroAtencionSede->referida_a_unidad_psicologica       = $camposValidacionQuintaPestana['referida_a_unidad_psicologica'] ?? null;
            $registroAtencionSede->observaciones_unidad_psicologica    = $camposValidacionQuintaPestana['observaciones_unidad_psicologica'] ?? null;
        }

        $tipo_servicio = ServiceType::where('cod_service', '03')->first();
        $registroAtencionSede->tipo_servicio_id = $tipo_servicio->id;

        $registroAtencionSede->user_creator_id = $id_user;

        // Guardar el registro en la base de datos
        $registroAtencionSede->save();

        // Devolver una respuesta
        return redirect()->route('registro_sedes.index')->with('success', 'Expediente actualizado con éxito!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Registro_Atencion_Sedes $registro_Atencion_Sedes)
    {
        //
    }

    public function getMunicipios($id)
    {
        //Obtener todos los municipios sin filtrar por departamento
        // $municipios = municipio::all();
        // $municipios = municipio::where('id', 'like', $id . '%')->get();

        $municipios = Municipio::where('department_id', $id)->get(['id', 'nombre']);
        return response()->json($municipios);
    }

    //INDEX REPORTES EXP
    public function reportes(){
        // $expedientes = Registro_Atencion_Sedes::all();
        return view('services.atencion_sedes.reportes');
    }

    //GENERAR PDF
    public function generarReporte(Request $request){

        $validatedData = $request->validate([
            'fecha_inicio' => 'required|date',
            'fecha_fin' => 'required|date',
            'tipo_reporte' => 'required',
        ]);

        $data = Registro_Atencion_Sedes::whereBetween('fecha_exp', [$validatedData['fecha_inicio'],
            $validatedData['fecha_fin']])->get();

        if ($validatedData['tipo_reporte'] == 'pdf') {
            // Generar reporte en PDF
            $expedientes = $data;
            $form_data = $validatedData;
            $pdf = Pdf::loadView('services.atencion_sedes.pdf_report', compact('form_data','expedientes'));
            return $pdf->stream('DEMI-reporte_expediente_AS.pdf');
        } else if ($validatedData['tipo_reporte'] == 'excel') {
            // Generar reporte en Excel
            $export = new class($data) implements FromCollection, WithHeadings, WithStyles, ShouldAutoSize, WithEvents
            {
                use RegistersEventListeners;
                private $data;

                public function __construct($data)
                {
                    $this->data = $data;
                }

                public function collection()
                {
                    return $this->data->map(function ($item, $index) {
                        //Consulta escolarididad
                        try{
                            $escolaridad = $item->escolaridad;
                            $escolaridad = Escolaridad::where('id', $escolaridad)->first();
                            $escolaridad = $escolaridad->nombre;
                        } catch (Exception $e) {
                            $escolaridad = null;
                        }

                        //Consulta de pueblo
                        try{
                            $pueblo = $item->pueblo;
                            $pueblo = Pueblo::where('id', $pueblo)->first();
                            $pueblo = $pueblo->name;
                        } catch (Exception $e) {
                            $pueblo = null;
                        }

                        //Comunidad lingüística	
                        try{
                            $comunidad_linguistica = $item->comunidad_linguistica;
                            $comunidad_linguistica = ComunidadLinguistica::where('id', $comunidad_linguistica)->first();
                            $comunidad_linguistica = $comunidad_linguistica->nombre;
                        } catch (Exception $e) {
                            $comunidad_linguistica = null;
                        }

                        //Departamento
                        try{
                            $departamento = $item->nac_department_id;
                            $departamento = Department::where('id', $departamento)->first();
                            $departamento = $departamento->name;
                        } catch (Exception $e) {
                            $departamento = null;
                        }

                        //Municipio
                        try{
                            $municipio = $item->nac_muni_id;
                            $municipio = Municipio::where('id', $municipio)->first();
                            $municipio = $municipio->nombre;
                        } catch (Exception $e) {
                            $municipio = null;
                        }

                        //Trabaja o no
                        if($item->trabaja == 1){
                            $trabaja = 'Si';
                        } else {
                            $trabaja = 'No';
                        }

                        //Estado
                        if($item->estado == 1){
                            $estado = 'Nuevo';
                        } elseif ($item->estado == 2) {
                            $estado = 'Antiguo';
                        }elseif ($item->estado == 3){
                            $estado = 'Reingreso';
                        } else {
                            $estado = 'N/A';
                        }

                        // Sesión atención
                        $data = json_decode($item->sesion_atencion);
                        $sesion_atencion = '';
                        if($data){
                            foreach ($data as $sesion) {
                                $sesion_atencion .= $sesion[0] . ' - ' . $sesion[1] . ', ';
                            }
                        }

                        // Sesión orientación
                        $data = json_decode($item->sesion_orientacion);
                        $sesion_orientacion = '';
                        if($data){
                            foreach ($data as $sesion) {
                                $sesion_orientacion .= $sesion[0] . ' - ' . $sesion[1] . ', ';
                            }
                        }

                        return [
                            'Número de expediente' => $item->exp_no ?: 'N/A',
                            'Fecha de ingreso del expediente' => $item->fecha_exp ?: 'N/A',
                            'Hora de ingreso del expediente' => $item->hora_exp ?: 'N/A',
                            'Fecha de primera atención' => $item->fecha_pa ?: 'N/A',
                            'Primer nombre' => $item->nombre ?: 'N/A',
                            'Segundo nombre' => $item->seg_nombre ?: 'N/A',
                            'Tercer nombre' => $item->ter_nombre ?: 'N/A',
                            'Primer apellido' => $item->apellido ?: 'N/A',
                            'Segundo apellido' => $item->apellido2 ?: 'N/A',
                            'Apellido de casada' => $item->apellido_cas ?: 'N/A',
                            'Fecha de nacimiento' => $item->fecha_nac ?: 'N/A',
                            'Edad' => $item->edad ?: 'N/A',
                            'Sexo' => $item->sexo ?: 'N/A',
                            'Nacionalidad' => $item->nacionalidad ?: 'N/A',
                            'Estado civil' => $item->estado_civil ?: 'N/A',
                            'Escolaridad' => $escolaridad ?: 'N/A',
                            'Escolaridad código' => $item->escolaridad ?: 'N/A',
                            'Pueblo' => $pueblo ?: 'N/A',
                            'Pueblo código' => $item->pueblo ?: 'N/A',
                            'Comunidad lingüística' => $comunidad_linguistica ?: 'N/A',
                            'Comunidad lingüística código' => $item->comunidad_linguistica ?: 'N/A',
                            'Religión' => $item->religion ?: 'N/A',
                            'Discapacidad' => $item->discapacidad ?: 'N/A',
                            'Cantidad hijos' => $item->hijos ?: 'N/A',
                            'Cantidad hijas' => $item->hijas ?: 'N/A',
                            'Dirección de casa' => $item->direccion_casa ?: 'N/A',
                            'Teléfono de casa' => $item->tel_casaa ?: 'N/A',
                            'Teléfono móvil' => $item->tel_movil ?: 'N/A',
                            'Teléfono de referencia' => $item->tel_referencia ?: 'N/A',
                            'Departamento' => $departamento ?: 'N/A',
                            'Departamento código' => $item->nac_department_id ?: 'N/A',
                            'Municipio' => $municipio ?: 'N/A',
                            'Municipio código' => $item->nac_muni_id ?: 'N/A',
                            'Trabaja' => $item->trabaja ?: 'N/A',
                            'Profesión' => $item->ocupacion ?: 'N/A',
                            'Identificación de necesidades' => $item->identificacion_necesidades ?: 'N/A',
                            'Información de los servicios que la DEMI brinda' => $item->servicios_brindados ?: 'N/A',
                            'Identificación de riesgos por la violencia vivida' => $item->riesgo_violencia ?: 'N/A',
                            'Especificación de riesgo' => $item->especificacion_riesgo ?: 'N/A',
                            'Persona que ha provocado la violencia' => $item->agresor ?: 'N/A',
                            'Frecuencia con los que estos hechos ocurren' => $item->frecuencia_eventos ?: 'N/A',
                            'Antecedentes de las acciones realizadas por la usuaria' => $item->historial_acciones_usuario ?: 'N/A',
                            'Motivo de consulta' => $item->motivo_consulta ?: 'N/A',
                            'Atención directa y/o referencia interna' => $item->tipo_atencion ?: 'N/A',
                            'Estado expediente unidad social' => $item->estado ?: 'N/A',
                            'Acciones desarrolladas' => $item->acciones_desarrolladas ?: 'N/A',
                            'Referida a(unidad social)' => $item->referida_a ?: 'N/A',
                            'Observaciones unidad social' => $item->observaciones_unidad_social ?: 'N/A',
                            'Estado expediente unidad jurídica' => $item->estado_expediente_unidad_juridica ?: 'N/A',
                            'Tipología' => $item->tipologia ?: 'N/A',
                            'Familia' => $item->familia ?: 'N/A',
                            'Recepción de documentos' => $item->recepcion_documentos ?: 'N/A',
                            'Redacción de demanda' => $item->redaccion_demanda ?: 'N/A',
                            'Firma demanda' => $item->firma_demanda ?: 'N/A',
                            'Ingreso de demanda' => $item->ingreso_demanda ?: 'N/A',
                            'Recepción de demanda' => $item->recepcion_demanda ?: 'N/A',
                            'Fechas audiencia' => $item->fechas_audiencia ?: 'N/A',
                            'Redacción de otros memoriales' => $item->redaccion_otros_memoriales ?: 'N/A',
                            'Conclusión de este proceso' => $item->conclusion_este_proceso ?: 'N/A',
                            'Referida a(unidad juridica)' => $item->referida_a_unidad_juridica ?: 'N/A',
                            'Observaciones unidad jurídica' => $item->observaciones_unidad_juridica ?: 'N/A',
                            'Estado expediente unidad psicológica' => $item->estado_expediente_unidad_psicologica ?: 'N/A',
                            'Ha recibido atención psicológica' => $item->atencion_psicologica_recibida ?: 'N/A',
                            'Lugar de atención psicológica' => $item->lugar_atencion_psicologica_recibida ?: 'N/A',
                            'Tipo de atención brindada' => $item->tipo_atencion_brindada ?: 'N/A',
                            'Fecha(s) de atención' => $item->fechas_atencion_recibidas ?: 'N/A',
                            'Tipo de violencia' => $item->tipos_violencia ?: 'N/A',
                            'Sesiones de atención' => $sesion_atencion ?: 'N/A',
                            'Diagnóstico en atención' => $item->diagnostico_atencion ?: 'N/A',
                            'Evaluación' => $item->evaluacion_atencion ?: 'N/A',
                            'Orientación psicológica' => $item->orientacion_psicologica ?: 'N/A',
                            'Sesiones de orientación' => $sesion_orientacion ?: 'N/A',
                            'Diagnóstico de orientación' => $item->diagnostico_orientacion ?: 'N/A',
                            'Referida a(unidad psicológica)' => $item->referida_a_unidad_psicologica ?: 'N/A',
                            'Observaciones unidad psicológica' => $item->observaciones_unidad_psicologica ?: 'N/A'
                        ];
                    });
                }

                public function headings(): array
                {
                    return [
                        'Número de expediente',
                        'Fecha de ingreso del expediente',
                        'Hora de ingreso del expediente',
                        'Fecha de primera atención',
                        'Primer nombre',
                        'Segundo nombre',
                        'Tercer nombre',
                        'Primer apellido',
                        'Segundo apellido',
                        'Apellido de casada',
                        'Fecha de nacimiento',
                        'Edad',
                        'Sexo',
                        'Nacionalidad',
                        'Estado civil',
                        'Escolaridad',
                        'Escolaridad código',
                        'Pueblo',
                        'Pueblo código',
                        'Comunidad lingüística',
                        'Comunidad lingüística código',
                        'Religión',
                        'Discapacidad',
                        'Cantidad hijos',
                        'Cantidad hijas',
                        'Dirección de casa',
                        'Teléfono de casa',
                        'Teléfono móvil',
                        'Teléfono de referencia',
                        'Departamento',
                        'Departamento código',
                        'Municipio',
                        'Municipio código',
                        'Trabaja',
                        'Profesión',
                        'Identificación de necesidades',
                        'Información de los servicios que la DEMI brinda',
                        'Identificación de riesgos por la violencia vivida',
                        'Especificación de riesgo',
                        'Persona que ha provocado la violencia',
                        'Frecuencia con los que estos hechos ocurren',
                        'Antecedentes de las acciones realizadas por la usuaria',
                        'Motivo de consulta',
                        'Atención directa y/o referencia interna',
                        'Estado expediente unidad social',
                        'Acciones desarrolladas',
                        'Referida a(unidad social)',
                        'Observaciones unidad social',
                        'Estado expediente unidad jurídica',
                        'Tipología',
                        'Familia',
                        'Recepción de documentos',
                        'Redacción de demanda',
                        'Firma demanda',
                        'Ingreso de demanda',
                        'Recepción de demanda',
                        'Fechas audiencia',
                        'Redacción de otros memoriales',
                        'Conclusión de este proceso',
                        'Referida a(unidad juridica)',
                        'Observaciones unidad jurídica',
                        'Estado expediente unidad psicológica',
                        'Ha recibido atención psicológica',
                        'Lugar de atención psicológica',
                        'Tipo de atención brindada',
                        'Fecha(s) de atención',
                        'Tipo de violencia',
                        'Sesiones de atención',
                        'Diagnóstico en atención',
                        'Evaluación',
                        'Orientación psicológica',
                        'Sesiones de orientación',
                        'Diagnóstico de orientación',
                        'Referida a(unidad psicológica)',
                        'Observaciones unidad psicológica',
                    ];
                }

                public function styles(Worksheet $sheet)
                {
                    $sheet->getStyle('A4:M4')->applyFromArray([
                        'font' => [
                            'bold' => true
                        ],
                        'fill' => [
                            'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                            'startColor' => [
                                'argb' => 'FFFF00' // Color amarillo para los encabezados
                            ]
                        ]
                    ]);
                }

                public static function beforeSheet(BeforeSheet $event)
                {
                    //$event->sheet->getDelegate()->mergeCells('A1:B3');
                    $drawing = new Drawing();
                    $drawing->setName('Logo');
                    $drawing->setDescription('Logo de la Empresa');
                    $drawing->setPath(public_path('assets/img/logo.png')); // Asegúrate de que la ruta sea correcta
                    $drawing->setHeight(60); // Ajusta la altura según sea necesario
                    $drawing->setCoordinates('A1'); // Ajusta la posición según sea necesario
                    $drawing->setWorksheet($event->sheet->getDelegate());
                    // Insertar filas adicionales al principio de la hoja
                    $event->sheet->getDelegate()->insertNewRowBefore(2, 2);
                }

                public function registerEvents(): array
                {
                    return [
                        BeforeSheet::class => [self::class, 'beforeSheet'],
                    ];
                }

            };

            return Excel::download($export, 'DEMI-reporte_expedienteAS_'.
                $validatedData['fecha_inicio'].'_al_'.$validatedData['fecha_fin'].'.xlsx');
        }
    }

}
