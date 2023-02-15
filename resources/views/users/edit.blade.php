@extends('layout')

@section('title', 'Editar perfil')

@section('content')
    <div class="content">
        <h1>Editar perfil</h1>
        <form action="{{ route('users.update', $user) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <label for="imagen">Imagen de perfil</label>
            <input type="file" name="imagen" id="imagen">
            @error('imagen')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name', $user->name) }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="password">Contraseña</label>
            <input type="password" name="password" id="password">
            @error('password')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="password_confirmation">Confirmar contraseña</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
            @error('password_confirmation')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="twitch">Twitch</label>
            <input type="text" name="twitch" id="twitch" value="{{ old('twitch', $user->twitch) }}">
            @error('twitch')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="instagram">Instagram</label>
            <input type="text" name="instagram" id="instagram" value="{{ old('instagram', $user->instagram) }}">
            @error('instagram')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="twitter">Twitter</label>
            <input type="text" name="twitter" id="twitter" value="{{ old('twitter', $user->twitter) }}">
            @error('twitter')
                <span class="error">{{ $message }}</span>
            @enderror
            <input class="boton" type="submit" name="enviar" value="Actualizar perfil">
        </form>
    </div>
@endsection
