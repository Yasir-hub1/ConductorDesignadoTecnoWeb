<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Models\Cliente;
use App\Models\User;
use App\Models\Conductor;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('auth.signin');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Obtener el usuario por el correo
        $user = User::where('correo', $request->correo)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($user && Hash::check($request->password, $user->password)) {
            // Iniciar sesión manualmente
            Auth::login($user, $request->has('rememberMe'));

            // Regenerar la sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirigir al usuario al dashboard
            return redirect()->intended('/dashboard');
        }

        // Si la autenticación falla, redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('correo'));
    }




    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/sign-in');
    }




    public function inicioSessionCliente(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Obtener el usuario por el correo
        $cliente = Cliente::where('correo', $request->correo)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($cliente && Hash::check($request->password, $cliente->password)) {
            // Iniciar sesión manualmente
            Auth::login($cliente, $request->has('rememberMe'));

            // Regenerar la sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirigir al usuario al dashboard
            return redirect()->route('cliente.inicio')->with('success', 'Bienvenido');
        }

        // Si la autenticación falla, redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'message' => 'The provided credentials do not match our records.',
        ])->withInput($request->only('correo'));
    }


    public function inicioSessionConductor(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'correo' => 'required|email',
            'password' => 'required',
        ]);

        // Obtener el usuario por el correo
        $conductor = Conductor::where('correo', $request->correo)->first();

        // Verificar si el usuario existe y la contraseña es correcta
        if ($conductor && Hash::check($request->password, $conductor->password)) {
            // Iniciar sesión manualmente
            Auth::login($conductor, $request->has('rememberMe'));

            // Regenerar la sesión para prevenir ataques de fijación de sesión
            $request->session()->regenerate();

            // Redirigir al usuario al dashboard
            return redirect()->route('conductor.inicio')->with('success', 'Bienvenido');
        }

        // Si la autenticación falla, redirigir de vuelta con un mensaje de error
        return back()->withErrors([
            'message' => 'Credenciales incorrectas',
        ])->withInput($request->only('correo'));
    }
}
