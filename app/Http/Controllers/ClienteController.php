<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\MetodoDePago;
use App\Models\SolicitarServicio;
use App\Models\transacciones;
use Carbon\Carbon;
use finfo;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clientes = Cliente::orderBy('id', 'desc')->paginate(10);
        return view("usuarios.cliente.index", compact('clientes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("usuarios.cliente.create");
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
            'ci' => 'required',
        ]);

        // Hashear la contraseña antes de guardar
        $validatedData['password'] = bcrypt($request->input('ci'));

        // Añadir valores estáticos a los datos validados
        $validatedData['tipo_usuario'] = 'Cliente'; // Valor estático para tipo_usuario
        $validatedData['id_rol'] = 3; // Valor estático para id_rol

        // Crear un nuevo cliente y guardar los datos
        $cliente = Cliente::create($validatedData);

        // Verificar si el cliente fue guardado correctamente
        if ($cliente) {
            return redirect()->route('cliente.index')->with('success', 'Cliente creado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al crear el cliente.']);
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(Cliente $cliente)
    {
        $cliente = Cliente::find(5);
        return view("usuarios.cliente.Edit");
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $cliente = Cliente::find($request->id_cliente);
        return view("usuarios.cliente.edit", compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cliente $cliente)
    {
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'nombre' => 'required',
            'apellido' => 'required',
            'correo' => 'required|email|max:255',
            'celular' => 'required|string|max:20',
            'fecha_de_nacimiento' => 'required|date',
            'genero' => 'required|string',
            'ci'=>'required|string',
        ]);

        // Si la contraseña está presente en la solicitud, hashearla
        if ($request->has('password') && !empty($request->input('password'))) {
            $validatedData['password'] = bcrypt($request->input('ci'));
        } else {
            // Mantener la contraseña actual si no se envió una nueva
            unset($validatedData['password']);
        }

        // Añadir valores estáticos a los datos validados
        $validatedData['tipo_usuario'] = 'Cliente'; // Valor estático para tipo_usuario
        $validatedData['id_rol'] = 3; // Valor estático para id_rol

        // Actualizar el cliente y guardar los datos
        $cliente->update($validatedData);

        // Verificar si el cliente fue actualizado correctamente
        if ($cliente) {
            return redirect()->route('cliente.index')->with('success', 'Cliente actualizado correctamente');
        } else {
            return redirect()->back()->withErrors(['msg' => 'Error al actualizar el cliente.']);
        }
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $cliente=Cliente::findOrFail($id);
        $cliente->delete();
        return redirect()->route('cliente.index');
    }



    public function login(){
        return view('view-cliente.Auth.login');
    }


    public function inicio(){
        $reservas = SolicitarServicio::with(['transaccion.metodoPago'])->where("solicitar_servicio.id_cliente",auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        // $reservas=SolicitarServicio::where("id_cliente",auth()->user()->id)->orderBy('id', 'desc')->paginate(10);
        // dd($reservas);
        return view('view-cliente.views.inicio',compact("reservas"));
    }



    public function pagoReserva(Request $request){
     $id_reserva=$request->id_reserva;
     return view('view-cliente.views.pago',compact("id_reserva"));
    }


}
