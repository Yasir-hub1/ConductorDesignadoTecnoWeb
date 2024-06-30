<?php

namespace App\Http\Controllers;

use App\Models\Conductor;
use App\Models\SolicitarServicio;
use Illuminate\Http\Request;

class ConductorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $conductores = Conductor::orderBy('id', 'desc')->paginate(10);
        return view("usuarios.Conductor.index", compact('conductores'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("usuarios.Conductor.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required',

            'celular' => 'required',
            'fecha_de_nacimiento' => 'required|date',
            'genero' => 'required',

            'numero_de_licencia_de_conducir' => 'required',
            'tipo_de_licencia' => 'required|max:3',
            'fecha_de_vencimiento_de_la_licencia' => 'required',
            'celular' => 'required'

        ]);

        // Hashear la contraseña antes de guardar
        $validatedData['password'] = bcrypt($request->input('celular'));

        // Añadir valores estáticos a los datos validados
        $validatedData['tipo_usuario'] = 'Conductor'; // Valor estático para tipo_usuario
        $validatedData['id_rol'] = 2; // Valor estático para id_rol
        $validatedData['estado']="inactivo";
        // Crear un nuevo cliente y guardar los datos
        $conductor =Conductor::create($validatedData);

        // Verificar si el conductor fue guardado correctamente
        if ($conductor) {
            return redirect()->route('conductor.index')->with('success', 'conductor creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el cliente.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show()
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $conductor = Conductor::find($request->id_conductor);
        return view("usuarios.Conductor.edit", compact('conductor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Conductor $conductor)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|max:255',
            'celular' => 'required|string|max:20',
            'fecha_de_nacimiento' => 'required|date',
            'genero' => 'required|string',
            'numero_de_licencia_de_conducir' => 'required',
            'tipo_de_licencia' => 'required|max:3',
            'fecha_de_vencimiento_de_la_licencia' => 'required',
            'celular' => 'required'
        ]);

        // Si la contraseña está presente en la solicitud, hashearla
        if ($request->has('password') && !empty($request->input('password'))) {
            $validatedData['password'] = bcrypt($request->input('celular'));
        } else {
            // Mantener la contraseña actual si no se envió una nueva
            unset($validatedData['password']);
        }

        // Añadir valores estáticos a los datos validados
        $validatedData['tipo_usuario'] = 'Conductor'; // Valor estático para tipo_usuario
        $validatedData['id_rol'] = 3; // Valor estático para id_rol

        $validatedData['estado']="inactivo";
        // Actualizar el conductor y guardar los datos
        $conductor->update($validatedData);

        // Verificar si el conductor fue actualizado correctamente
        if ($conductor) {
            return redirect()->route('conductor.index')->with('success', 'conductor actualizado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al actualizar el conductor.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $conductor=Conductor::findOrFail($id);
        $conductor->delete();
        return redirect()->route('conductor.index');
    }



    public function login(){
        return view('view-conductor.Auth.login');
    }

    public function inicio(){
        $reservas=SolicitarServicio::where("id_conductor",auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        return view('view-conductor.views.inicio',compact("reservas"));
    }
}
