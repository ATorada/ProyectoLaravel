@extends('layout')

@section('title', 'Registrate')

@section('content')
    <div class="content">
        <h1>Registrar</h1>
        <form action="{{ route('register') }}" method="POST">
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="{{ old('email') }}">
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            <input type="submit" name="enviar" value="Registrarse">
        </form>
    </div>
@endsection
