<?php

namespace App\Http\Controllers;

use App\Models\Discapacidad;
use App\Models\Pueblo;
use Illuminate\Http\Request;

class CatalogsController extends Controller
{
    //DISCAPACIDADES
    public  function index_disc(){
        $discapacidades = Discapacidad::all();
        return view('catalogs.discapacidades.index', ['discapacidades' => $discapacidades]);
    }

    public function create_disc()
    {
        return view('catalogs.discapacidades.create');
    }

    public function store_disc(Request $request)
    {

        $request->validate([
            'nombre' => 'required:string',
        ]);

        $discapacidad = new Discapacidad();
        $discapacidad->name = $request->nombre;
        $discapacidad->save();

        return redirect()->route('discapacidades.index')->with('success', 'Registro creado con éxito.');
    }

    public function edit_disc($id)
    {
        $discapacidad = Discapacidad::findOrFail($id);

        // Aquí puedes pasar cualquier otra información necesaria para la vista
        return view('catalogs.discapacidades.edit', compact('discapacidad'));
    }

    public function update_disc(Request $request, $id)
    {

        $request->validate([
            'nombre' => 'required:string',
        ]);

        $discapacidad = Discapacidad::findOrFail($id);

        $discapacidad->name = $request->nombre;

        // Guardar los cambios
        $discapacidad->save();

        return redirect()->route('discapacidades.index')->with('success', 'Registro editado con éxito.');

    }

    // PUEBLOS
    public  function index_pueb(){
        $pueblos = Pueblo::all();
        return view('catalogs.pueblos.index', ['pueblos' => $pueblos]);
    }

    public function create_pueb()
    {
        return view('catalogs.pueblos.create');
    }

    public function store_pueb(Request $request)
    {

        $request->validate([
            'nombre' => 'required:string',
        ]);

        $pueblo = new Pueblo();
        $pueblo->name = $request->nombre;
        $pueblo->save();

        return redirect()->route('pueblos.index')->with('success', 'Registro creado con éxito.');
    }

    public function edit_pueb($id)
    {
        $pueblo = Pueblo::findOrFail($id);

        // Aquí puedes pasar cualquier otra información necesaria para la vista
        return view('catalogs.pueblos.edit', compact('pueblo'));
    }

    public function update_pueb(Request $request, $id)
    {

        $request->validate([
            'nombre' => 'required:string',
        ]);

        $pueblo = Pueblo::findOrFail($id);

        $pueblo->name = $request->nombre;

        // Guardar los cambios
        $pueblo->save();

        return redirect()->route('pueblos.index')->with('success', 'Registro editado con éxito.');

    }

}
