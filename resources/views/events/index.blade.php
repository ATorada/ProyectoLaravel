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
                <a class="destacado" href="{{ route('events.show', $event) }}">
                    {{ $event->name }}
                </a>
                @auth
                    @if (auth()->user()->role == 'admin')
                        <br>
                        <br>
                        <a class="boton" href="{{ route('events.edit', $event) }}">Editar</a>
                        <form action="{{ route('events.destroy', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Eliminar">
                        </form>
                    @endif
                    @if ($event->users->contains(auth()->user()))
                        <form action="{{ route('events.leave', $event) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <input type="submit" value="Borrarse">
                        </form>
                    @else
                        <form action="{{ route('events.join', $event) }}" method="POST">
                            @csrf
                            <input type="submit" value="Unirse">
                        </form>
                    @endif
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
