<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\EditUserRequest;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Devuelve todos los usuarios junto con la vista users.index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Obtiene todos los usuarios
        $users = User::all();
        //Comprueba si el usuario tiene imagen
        foreach ($users as $user) {
            //Si el usuario tiene imagen, asigna true a la propiedad imagen
            if (Storage::disk('public')->exists('img/avatar'.'/'.$user->id.'.jpg')) {
                $user->imagen = true;
            }
        }
        //Devuelve la vista users.index con los usuarios obtenidos
        return view('users.index', compact('users'));
    }

    /**
     * Devuelve la vista users.create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Implementado en LoginController
    }

    /**
     * Guarda un nuevo usuario
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Implementado en LoginController
    }

    /**
     * Muestra el usuario especificado
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //Comprueba si el usuario tiene imagen
        if (Storage::disk('public')->exists('img/avatar'.'/'.$user->id.'.jpg')) {
            //Si el usuario tiene imagen, asigna true a la propiedad imagen
            $user->imagen = true;
        }
        //Devuelve la vista users.show con el usuario obtenido
        return view('users.show', compact('user'));
    }

    /**
     * Devuelve la vista users.edit
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //Comprueba si el usuario es el mismo que el que está logueado
        if (auth()->user()->id == $user->id) {
            //Devuelve la vista users.edit con el usuario obtenido
            return view('users.edit', compact('user'));
        } else {
            //Si no es el mismo usuario, redirige a la vista users.index
            return redirect()->route('users.index');
        }
    }

    /**
     * Actualiza el usuario especificado
     *
     * @param  App\Http\Requests\EditUserRequest  $request
     * @param User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $user)
    {
        //Comprueba si el usuario es el mismo que el que está logueado
        if (auth()->user()->id == $user->id) {
            //Actualiza los datos del usuario
            $user->name = $request->name;

            //Comprueba si el usuario ha cambiado la contraseña
            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            //Comprueba si el usuario ha subido una imagen
            if ($request->hasFile('imagen')) {
                //Si el usuario ha subido una imagen, la guarda en el disco public en la carpeta img/avatar
                $image = $request->file('imagen');
                $name = $user->id . '.' . 'jpg';
                Storage::disk('public')->put('img/avatar'.'/'.$name, file_get_contents($image), 'public');
            }

            $user->twitch = $request->twitch;
            $user->twitter = $request->twitter;
            $user->instagram = $request->instagram;

            if($request->birthday){
                $user->birthday = $request->birthday;
            } else {
                $user->birthday = null;
            }

            //Guarda los cambios
            $user->save();

            //Redirige a la vista users.show con un mensaje de éxito
            return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente');
        } else {
            //Si no es el mismo usuario, redirige a la vista users.index
            return redirect()->route('users.index');
        }
    }

    /**
     * Elimina el usuario especificado (No se usa)
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //Comprueba si el usuario es el mismo que el que está logueado
        if (auth()->user()->id == $user->id) {
            //Saca al usuario de todos los eventos
            $user->events()->detach();
            //Elimina el usuario
            $user->delete();
            //Cierra la sesión
            auth()->logout();
            //Redirige a la vista index
            return redirect()->route('index');
        } else {
            //Si no es el mismo usuario, redirige a la vista users.index
            return redirect()->route('users.index');
        }
    }
}
