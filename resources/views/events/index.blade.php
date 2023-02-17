@extends('layout')

@section('title', 'Eventos')

@section('content')
    <div class="content">
        <div class="success">
            @if (session('success'))
                {{ session('success') }}
            @endif
        </div>
        <h1>Eventos</h1>
        @forelse ($events as $event)
            @if ($loop->first)
                <ul>
            @endif
            <li>
                @auth
                    <a class="destacado" href="{{ route('events.show', $event) }}">{{ $event->name }}</a>
                @else
                    {{ $event->name }}
                @endauth
                @if ($event->tags)
                    <p>Tags: {{ $event->tags }}</p>
                @endif
                @auth
                    <div class="botones">
                        @if (auth()->user()->role == 'admin')
                            <a class="boton" href="{{ route('events.edit', $event) }}">Editar</a>

                            <form action="{{ route('events.destroy', $event) }}" method="POST">
                                @csrf
                                @method ('DELETE')
                                <input type="submit" class="botonRojo" value="Eliminar">
                            </form>
                        @endif
                        @if ($event->users->contains(auth()->user()))
                            <form action="{{ route('events.leave', ['event' => $event, 'ruta' => 'index']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <input type="submit" class="botonRojo" value="Borrarse">
                            </form>
                        @else
                            <form action="{{ route('events.join', ['event' => $event, 'ruta' => 'index']) }}" method="POST">
                                @csrf
                                <input type="submit" class="botonVerde" value="Unirse">
                            </form>
                        @endif
                    </div>
                @endauth
            </li>
            @if ($loop->last)
                </ul>
            @endif
        @empty
            No hay eventos registrados.
        @endforelse
    </div>
@endsection
