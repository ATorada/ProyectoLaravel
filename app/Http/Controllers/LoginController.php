<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /**
     * Devuelve la vista auth.register
     *
     * @return \Illuminate\Http\Response
     */
    public function registerForm()
    {
        return view('auth.register');
    }

    /**
     * Devuelve la vista auth.login
     *
     * @return \Illuminate\Http\Response
     */
    public function loginForm()
    {
        return view('auth.login');
    }

    /**
     * Crea un nuevo usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        //Crea un nuevo usuario
        $user = new User();
        //Asigna los valores del formulario al usuario
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'member';
        //Guarda el usuario
        $user->save();

        //Inicia sesión con el usuario creado
        Auth::login($user);

        //Redirige a la vista index
        return redirect()->route('index');
    }

    /**
     * Inicia sesión con un usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        //Obtiene las credenciales del formulario
        $credenciales = $request->only('email', 'password');
        $recuerdame = (request()->remember) ? true : false;

        //Comprueba si las credenciales son correctas y si es así, inicia sesión
        if (Auth::guard('web')->attempt($credenciales, $recuerdame)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            //Si no es así, devuelve la vista auth.login con un mensaje de error
            $error = 'Usuario o contraseña incorrectos';
            return view('auth.login', compact('error'));
        }
    }

    /**
     * Cierra la sesión del usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function logout(Request $request)
    {
        //Cierra la sesión del usuario
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
