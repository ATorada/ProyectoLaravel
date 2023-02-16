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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //Si es administrador, muestra todos los eventos sino solo los públicos
        if (isset(auth()->user()->role) && auth()->user()->role == "admin") {
            $events = Event::all();
        } else {
            $events = Event::where('visibility', 1)->get();
        }

        return view('events.index', compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        if (auth()->user()->role == "admin") {
            return view('events.create');
        } else {
            return redirect()->route('events.index');
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EventRequest $request)
    {
        if (auth()->user()->role == "admin") {
        $event = new Event();
        $event->name = $request->name;
        $event->slug = Str::slug($request->name);
        $event->description = $request->description;
        $event->visibility = $request->visibility;
        $event->date = $request->date;
        $event->hour = $request->hour;
        $event->location = $request->location;

        $event->save();

        return redirect()->route('events.show', $event->slug)->with('success', 'Evento creado correctamente');
        } else {
            return redirect()->route('events.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {

        if ($event->visibility == 1 || auth()->user()->role == "admin") {
            return view('events.show', compact('event'));
        } else {
            return redirect()->route('events.index');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {

        if (auth()->user()->role == "admin") {
            return view('events.edit', compact('event'));
        } else {
            return redirect()->route('events.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(EventRequest $request, Event $event)
    {

        if (auth()->user()->role == "admin") {

            $event->name = $request->name;
            $event->slug = Str::slug($request->name);
            $event->description = $request->description;
            $event->visibility = $request->visibility;
            $event->date = $request->date;
            $event->hour = $request->hour;
            $event->location = $request->location;
            $event->tags = $request->tags;

            $event->save();

            return redirect()->route('events.show', $event->slug)->with('success', 'Evento actualizado correctamente');
        } else {
            return redirect()->route('events.index');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if (auth()->user()->role == "admin") {
            $event->users()->detach();
            $event->delete();

            return redirect()->route('events.index')->with('success', 'Evento eliminado correctamente');
        } else {
            return redirect()->route('events.index');
        }
    }

    /**
     * Leave the user from the event.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function join(Request $request, Event $event)
    {
        if (auth()->user()->role == "admin" || $event->visibility == 1) {
            $event->users()->attach(auth()->user()->id);

            if ($request->get('ruta') == 'index') {
                return redirect()->route('events.index')->with('success', 'Te has unido al evento correctamente');
            } else {
                return redirect()->route('events.show', $event->slug)->with('success', 'Te has unido al evento correctamente');
            }
        }
    }


    /**
     * Leave the user from the event.
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function leave(Request $request, Event $event)
    {
        if (auth()->user()->role == "admin" || $event->visibility == 1) {
            $event->users()->detach(auth()->user()->id);
            if ($request->get('ruta') == 'index') {
                return redirect()->route('events.index')->with('success', 'Te has salido al evento correctamente');
            } else {
                return redirect()->route('events.show', $event->slug)->with('success', 'Te has salido al evento correctamente');
            }
        }
    }
}
