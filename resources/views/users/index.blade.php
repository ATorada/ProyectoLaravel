@extends('layout')

@section('title', 'Usuarios')

@section('content')
    <div class="content">
        <h1>Usuarios</h1>
            @forelse ($users as $user)
                @if ($loop->first)
                    <ul>
                @endif
                <li>
                    @auth
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
