<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function registerForm()
    {
        return view('auth.register');
    }

    public function loginForm()
    {
        return view('auth.login');
    }

    public function register(Request $request)
    {
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 'member';
        $user->save();

        Auth::login($user);

        return redirect()->route('index');
    }

    public function login(Request $request)
    {
        $credenciales = $request->only('email', 'password');
        $recuerdame = (request()->remember) ? true : false;

        if (Auth::guard('web')->attempt($credenciales, $recuerdame)) {
            $request->session()->regenerate();
            return redirect()->route('index');
        } else {
            $error = 'Usuario o contraseña incorrectos';
            return view('auth.login', compact('error'));
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
