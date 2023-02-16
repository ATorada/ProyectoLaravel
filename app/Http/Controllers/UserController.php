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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        foreach ($users as $user) {
            if (Storage::disk('public')->exists('img/avatar'.'/'.$user->id.'.jpg')) {
                $user->imagen = true;
            }
        }
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Implementado en LoginController
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //Implementado en LoginController
    }

    /**
     * Display the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        if (Storage::disk('public')->exists('img/avatar'.'/'.$user->id.'.jpg')) {
            $user->imagen = true;
        }
        return view('users.show', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (auth()->user()->id == $user->id) {
            return view('users.edit', compact('user'));
        } else {
            return redirect()->route('users.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(EditUserRequest $request, User $user)
    {
        if (auth()->user()->id == $user->id) {
            $user->name = $request->name;

            if ($request->password) {
                $user->password = Hash::make($request->password);
            }

            if ($request->hasFile('imagen')) {
                $image = $request->file('imagen');
                $name = $user->id . '.' . 'jpg';
                Storage::disk('public')->put('img/avatar'.'/'.$name, file_get_contents($image), 'public');
            }

            $user->twitch = $request->twitch;
            $user->twitter = $request->twitter;
            $user->instagram = $request->instagram;

            $user->save();

            return redirect()->route('users.show', $user->id)->with('success', 'Usuario actualizado correctamente');
        } else {
            return redirect()->route('users.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        if (auth()->user()->id == $user->id) {
            $user->delete();
            return redirect()->route('index');
        } else {
            return redirect()->route('users.index');
        }
    }
}
