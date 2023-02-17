@extends('layout')

@section('title', $user->name)

@section('content')
    <div class="content">
        <div class="success">
            @if (session('success'))
                {{ session('success') }}
            @endif
        </div>
        @if ($user->imagen)
            <img class="img_perfil" src="{{ asset('storage/img/avatar/' . $user->id . '.jpg') }}" alt="Imagen de perfil">
        @endif
        <h1>{{ $user->name }}</h1>
        <p>Usuario desde: {{ $user->created_at->format('d/m/Y') }}</p>
        @if ($user->birthday)
            <p>Fecha de nacimiento: {{ $user->birthday }}</p>
        @endif
        @if ($user->twitch)
            <a class="redSocial" href="https://www.twitch.tv/{{ $user->twitch }}"><img src="{{ asset('img/twitch.png') }}"
                    alt="Twitch"></a>
        @endif
        @if ($user->instagram)
            <a class="redSocial" href="https://www.instagram.com/{{ $user->instagram }}"><img
                    src="{{ asset('img/instagram.png') }}" alt="Instagram"></a>
        @endif
        @if ($user->twitter)
            <a class="redSocial" href="https://www.twitter.com/{{ $user->twitter }}"><img
                    src="{{ asset('img/twitter.png') }}" alt="Twitter"></a>
        @endif
        @auth
            @if (auth()->user()->id == $user->id)
                <br>
                <a class="boton" href="{{ route('users.edit', $user) }}">Editar perfil</a>
            @endif
        @endauth
    </div>
@endsection
