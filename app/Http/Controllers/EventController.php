<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class EventController extends Controller
{
    /**
     * Devuelve todos los eventos públicos o todos si es administrador junto con la vista events.index
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Si tiene rol y es admin, devuelve todos los eventos
        if (isset(auth()->user()->role) && auth()->user()->role == "admin") {
            $events = Event::all();
        } else {
            //Si no es admin, devuelve solo los eventos públicos
            $events = Event::where('visibility', 1)->get();
        }
        //Devuelve la vista events.index con los eventos obtenidos
        return view('events.index', compact('events'));
    }

    /**
     * Devuelve la vista events.create
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //Si el rol del usuario es admin, devuelve la vista events.create
        if (auth()->user()->role == "admin") {
            return view('events.create');
        } else {
            //Si no es admin, redirige a la vista events.index
            return redirect()->route('events.index');
        }
    }

    /**
     * Crea un nuevo evento
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        //Si el rol del usuario es admin, crea el evento
        if (auth()->user()->role == "admin") {
            //Crea un nuevo evento
            $event = new Event();
            //Asigna los valores del formulario al evento
            $event->name = $request->name;
            $event->slug = Str::slug($request->name);
            $event->description = $request->description;
            $event->visibility = $request->visibility;
            $event->date = $request->date;
            $event->hour = $request->hour;
            $event->location = $request->location;
            $event->tags = $request->tags;
            //Guarda el evento
            $event->save();

            //Redirige a la vista del evento creado con un mensaje de éxito
            return redirect()->route('events.show', $event->slug)->with('success', 'Evento creado correctamente');
        } else {
            //Si no es admin, redirige a la vista events.index
            return redirect()->route('events.index');
        }
    }

    /**
     * Devuelve la vista del evento si es público o si es administrador
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        //Si el evento es público o el usuario es administrador, devuelve la vista del evento
        if ($event->visibility == 1 || auth()->user()->role == "admin") {
            return view('events.show', compact('event'));
        } else {
            //Si no es público o no es administrador, redirige a la vista events.index
            return redirect()->route('events.index');
        }
    }

    /**
     * Devuelve la vista events.edit
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        //Si el rol del usuario es admin, devuelve la vista events.edit
        if (auth()->user()->role == "admin") {
            return view('events.edit', compact('event'));
        } else {
            //Si no es admin, redirige a la vista events.index
            return redirect()->route('events.index');
        }
    }

    /**
     * Actualiza el evento
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {
        //Si el rol del usuario es admin, actualiza el evento
        if (auth()->user()->role == "admin") {
            //Asigna los valores del formulario al evento
            $event->name = $request->name;
            $event->slug = Str::slug($request->name);
            $event->description = $request->description;
            $event->visibility = $request->visibility;
            $event->date = $request->date;
            $event->hour = $request->hour;
            $event->location = $request->location;
            $event->tags = $request->tags;
            //Guarda el evento
            $event->save();

            //Redirige a la vista del evento actualizado con un mensaje de éxito
            return redirect()->route('events.show', $event->slug)->with('success', 'Evento actualizado correctamente');
        } else {
            //Si no es admin, redirige a la vista events.index
            return redirect()->route('events.index');
        }
    }

    /**
     * Elimina el evento
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        //Si el rol del usuario es admin, elimina el evento
        if (auth()->user()->role == "admin") {
            //Elimina el evento separando primero los usuarios que participan en el evento
            $event->users()->detach();
            $event->delete();

            //Redirige a la vista events.index con un mensaje de éxito
            return redirect()->route('events.index')->with('success', 'Evento eliminado correctamente');
        } else {
            //Si no es admin, redirige a la vista events.index
            return redirect()->route('events.index');
        }
    }

    /**
     * Une al usuario al evento.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, Event $event)
    {
        //Si el usuario es administrador o el evento es público, une al usuario al evento
        if (auth()->user()->role == "admin" || $event->visibility == 1) {
            //Une al usuario al evento
            $event->users()->attach(auth()->user()->id);

            //Si la ruta es index, redirige a la vista events.index con un mensaje de éxito
            if ($request->get('ruta') == 'index') {
                return redirect()->route('events.index')->with('success', 'Te has unido al evento correctamente');
            } else {
                //Si la ruta es show, redirige a la vista del evento con un mensaje de éxito
                return redirect()->route('events.show', $event->slug)->with('success', 'Te has unido al evento correctamente');
            }
        }
    }


    /**
     * Elimina al usuario del evento.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function leave(Request $request, Event $event)
    {
        //Si el usuario es administrador o el evento es público, elimina al usuario del evento
        if (auth()->user()->role == "admin" || $event->visibility == 1) {
            //Elimina al usuario del evento
            $event->users()->detach(auth()->user()->id);

            //Si la ruta es index, redirige a la vista events.index con un mensaje de éxito
            if ($request->get('ruta') == 'index') {
                //Si la ruta es index, redirige a la vista events.index con un mensaje de éxito
                return redirect()->route('events.index')->with('success', 'Te has salido al evento correctamente');
            } else {
                //Si la ruta es show, redirige a la vista del evento con un mensaje de éxito
                return redirect()->route('events.show', $event->slug)->with('success', 'Te has salido al evento correctamente');
            }
        }
    }
}
