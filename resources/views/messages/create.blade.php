@extends('layout')

@section('title', 'Contacto')

@section('content')

    @if (session()->has('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    <div class="content">
        <h1>Contacto</h1>
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            <input type="text" name="name" placeholder="Nombre...">
            <input type="email" name="email" placeholder="Email...">
            <input type="text" name="subject" placeholder="Asunto...">
            <textarea name="text" placeholder="Mensaje..."></textarea>
            <input type="submit" value="Enviar">
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
