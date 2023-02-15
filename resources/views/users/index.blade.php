@extends('layout')

@section('title', 'Usuarios')

@section('content')
    <div class="content usuarios">
        <h1>Usuarios</h1>
            @forelse ($users as $user)
                @if ($loop->first)
                    <ul>
                @endif
                <li>
                    @auth
                        @if ($user->imagen)
                            <img class="img_usuario" src="{{ asset('storage/img/avatar/'.$user->id.'.jpg') }}" alt="Imagen de perfil">
                        @endif
                        <a class="destacado" href="{{ route('users.show', $user) }}">
                    @endauth
                    {{ $user->name }}
                    @auth
                        </a>
                    @endauth
                </li>
                @if ($loop->last)
                    </ul>
                @endif
            @empty
                No hay usuarios registrados.
            @endforelse
    </div>
@endsection
