@extends('layout')

@section('title', $event->name)

@section('content')
    <div class="content">
        <div class="success">
            @if (session('success'))
                {{ session('success') }}
            @endif
        </div>
        <h1>{{ $event->name }}</h1>
        @if ($event->date)
            <p>Fecha: {{ $event->date }}</p>
            @if ($event->hour)
                <p>Hora: {{ date('H:i', strtotime($event->hour)) }}</p>
            @endif
        @else
            <p>Fecha y hora: No especificadas</p>
        @endif
        <p>Descripción: {{ $event->description }}</p>
        @if ($event->location)
            <p>Lugar: {{ $event->location }}</p>
        @else
            <p>Lugar: No especificado</p>
        @endif
        @auth
            @if (auth()->user()->role == 'admin')
                <p>Visibilidad: {{ $event->visibility ? 'Público' : 'Privado' }}</p>
            @endif
        @endauth

        @if ($event->tags)
            <p>Tags: {{ $event->tags }}</p>
        @endif

        <div class="botones">
            @auth
                @if ($event->users->contains(auth()->user()))
                    <form action="{{ route('events.leave', ['event' => $event, 'ruta' => 'show']) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="botonRojo" value="Borrarse del evento">
                    </form>
                @else
                    <form action="{{ route('events.join', ['event' => $event, 'ruta' => 'show']) }}" method="POST">
                        @csrf
                        <input type="submit" class="botonVerde" value="Unirse al evento">
                    </form>
                @endif

                @if (auth()->user()->role == 'admin')
                    <form action="{{ route('events.destroy', $event) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <input type="submit" class="botonRojo" value="Eliminar evento">
                    </form>
                    <a class="boton" href="{{ route('events.edit', $event) }}">Editar evento</a>
                @endif
            @endauth
        </div>

        <h2>Asistentes</h2>
        <ul>
            @forelse ($event->users as $user)
                <li>
                    <a class="destacado" href="{{ route('users.show', $user) }}">{{ $user->name }}</a>
                </li>
            @empty
                <li>No hay asistentes</li>
            @endforelse
        </ul>

    </div>
@endsection
