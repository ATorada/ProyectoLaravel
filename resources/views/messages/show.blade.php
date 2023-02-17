@extends('layout')

@section('title', 'Mensaje ' . $message->id)

@section('content')
    <div class="content">
        <h1>Mensaje {{ $message->id }}</h1>
        <p>De: {{ $message->email }}</p>
        <p>Asunto: {{ $message->subject }}</p>
        <p>Mensaje: {{ $message->text }}</p>
        <p>Enviado: {{ $message->created_at->format('d/m/Y') }}</p>

        <form action="{{ route('messages.destroy', $message) }}" method="POST">
            @csrf
            @method('DELETE')
            <input class="botonRojo" type="submit" value="Eliminar">
        </form>
    </div>
@endsection
