@extends('layout')

@section('title', 'Editar evento')

@section('content')
    <div class="content">
        <h1>Editar evento</h1>
        <form action="{{ route('events.update', $event) }}" method="POST">
            @csrf
            @method('PUT')
            <label for="name">Nombre</label>
            <input type="text" name="name" value="{{ $event->name }}">
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="date">Fecha</label>
            <input type="date" name="date" value="{{ $event->date }}">
            @error('date')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="hour">Hora</label>
            <input type="hour" name="hour" value="{{ date('H:i', strtotime($event->hour)) }}">
            @error('hour')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="description">Descripción</label>
            <textarea name="description">{{ $event->description }}</textarea>
            @error('description')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="location">Lugar</label>
            <input type="text" name="location" value="{{ $event->location }}">
            @error('location')
                <span class="error">{{ $message }}</span>
            @enderror
            <label for="visibility">Visibilidad</label>
            <select name="visibility">
                <option value="1" {{ $event->visibility ? 'selected' : '' }}>Público</option>
                <option value="0" {{ $event->visibility ? '' : 'selected' }}>Privado</option>
            </select>
            @error('visibility')
                <span class="error">{{ $message }}</span>
            @enderror
            <input class="boton" type="submit" value="Editar">
        </form>
    </div>
@endsection

