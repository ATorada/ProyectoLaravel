@extends('layout')

@section('title', 'Iniciar sesión')

@section('content')
    <div class="content">
        <h1>Iniciar sesión</h1>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            <label for="remember">Recuérdame</label>
            <input type="checkbox" name="remember" id="remember">
            <input type="submit" name="enviar" value="Iniciar sesión">
        </form>
        @if ($errors->any())
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection
