@extends('layout')

@section('title', 'Crear evento')

@section('content')
    <div class="content">
        <h1>Crear evento</h1>
        <form action="{{ route('events.store') }}" method="POST">
            @csrf
            <label for="name">Nombre</label>
            <input type="text" name="name" id="name" value="{{ old('name') }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="description">Descripción</label>
            <textarea name="description" id="description">{{ old('description') }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="date">Fecha</label>
            <input type="date" name="date" id="date" value="{{ old('date') }}">
            @error('date')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="hour">Hora</label>
            <input type="hour" name="hour" id="hour" value="{{ old('hour') }}">
            @error('hour')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="location">Lugar</label>
            <input type="text" name="location" id="location" value="{{ old('location') }}">
            @error('location')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="visibility">Visibilidad</label>
            <select name="visibility" id="visibility">
                <option value="1">Público</option>
                <option value="0">Privado</option>
            </select>
            {{--
            <select name="tags[]" id="tags" multiple>
                @foreach ($tags as $tag)
                    <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                @endforeach
            </select>
            --}}
            <input class="boton" type="submit" value="Crear">
        </form>
    </div>
@endsection
