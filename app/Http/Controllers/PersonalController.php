<?php

namespace App\Http\Controllers;

use App\Models\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $personales = Personal::orderBy('id', 'desc')->paginate(10);
        return view("usuarios.personal.index", compact('personales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("usuarios.personal.create");
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
           
           
            'celular' => 'required',
            'salario' => 'required',
            'cargo' => 'required',
            'estado' => 'required',
           
        ]);
        
        // Hashear la contraseña antes de guardar
        $validatedData['password'] = bcrypt($request->input('celular'));

        // Añadir valores estáticos a los datos validados
        $validatedData['tipo_usuario'] = 'Personal'; // Valor estático para tipo_usuario
        $validatedData['id_rol'] = 1; // Valor estático para id_rol
      
        // Crear un nuevo cliente y guardar los datos
        $personal =Personal::create($validatedData);

        // Verificar si el personal fue guardado correctamente
        if ($personal) {
            return redirect()->route('personal.index')->with('success', 'personal creado correctamente');
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
        $personal = Personal::find($request->id_personal);
        return view("usuarios.personal.edit", compact('personal'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Personal $personal)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|max:255',
            'celular' => 'required|string|max:20',
            'fecha_de_nacimiento' => 'required|date',
            'genero' => 'required|string',
           
            'celular' => 'required',
            'salario' => 'required',
            'cargo' => 'required',
            'estado' => 'required',
        ]);
    
        // Si la contraseña está presente en la solicitud, hashearla
        if ($request->has('password') && !empty($request->input('password'))) {
            $validatedData['password'] = bcrypt($request->input('celular'));
        } else {
            // Mantener la contraseña actual si no se envió una nueva
            unset($validatedData['password']);
        }
    
        // Añadir valores estáticos a los datos validados
        $validatedData['tipo_usuario'] = 'Personal'; // Valor estático para tipo_usuario
        $validatedData['id_rol'] = 1; // Valor estático para id_rol
    
       
        // Actualizar el personal y guardar los datos
        $personal->update($validatedData);
    
        // Verificar si el personal fue actualizado correctamente
        if ($personal) {
            return redirect()->route('personal.index')->with('success', 'personal actualizado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al actualizar el personal.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $personal=Personal::findOrFail($id);
        $personal->estado='inactivo';
        $personal->update();
        return redirect()->route('personal.index');
    }
}
