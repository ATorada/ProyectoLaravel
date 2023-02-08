<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Http\Controllers\Controller;
use App\Http\Requests\EventRequest;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::all();
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
        $event = new Event();
        $event->name = $request->name;
        $event->description = $request->description;
        $event->visibility = $request->visibility;
        $event->date = $request->date;
        $event->hour = $request->hour;
        $event->location = $request->location;

        $event->save();

        return redirect()->route('events.show', $event->id)->with('success', 'Evento creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        if (auth()->user()) {
            if ($event->visibility == 1 || auth()->user()->role == "admin") {
                return view('events.show', compact('event'));
            } else {
                return redirect()->route('events.index');
            }
        } else {
            return redirect()->route('login');
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

        $event->name = $request->name;
        $event->description = $request->description;
        $event->visibility = $request->visibility;
        $event->date = $request->date;
        $event->hour = $request->hour;
        $event->location = $request->location;

        $event->save();

        return redirect()->route('events.show', $event->id)->with('success', 'Evento actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $event->delete();

        return redirect()->route('events.index');
    }

    public function join(Event $event)
    {
        $event->users()->attach(auth()->user()->id);

        if ($event->route == 'events.index') {
            return redirect()->route('events.index')->with('success', 'Te has unido al evento correctamente');
        } else {
            return redirect()->route('events.show', $event->id)->with('success', 'Te has unido al evento correctamente');
        }
    }

    public function leave(Event $event)
    {
        $event->users()->detach(auth()->user()->id);
        if ($event->route == 'events.index') {
            return redirect()->route('events.index')->with('success', 'Te has salido al evento correctamente');
        } else {
            return redirect()->route('events.show', $event->id)->with('success', 'Te has salido al evento correctamente');
        }
    }
}
