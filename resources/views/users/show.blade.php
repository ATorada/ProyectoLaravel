@extends('layout')

@section('title', $user->name)

@section('content')
    <div class="content">
        <div class="success">
            @if (session('success'))
                {{ session('success') }}
            @endif
        </div>
        <h1>{{ $user->name }}</h1>
        <p>Usuario desde: {{ $user->created_at->format('d/m/Y') }}</p>
        @if ($user->twitch)
            <p>Twitch: {{ $user->twitch }}</p>
        @endif
        @if ($user->instagram)
            <p>Instagram: {{ $user->instagram }}</p>
        @endif
        @if ($user->twitter)
            <p>Twitter: {{ $user->twitter }}</p>
        @endif
        @auth
            @if (auth()->user()->id == $user->id)
                <a class="boton" href="{{ route('users.edit', $user) }}">Editar perfil</a>
            @endif
        @endauth
    </div>
@endsection
