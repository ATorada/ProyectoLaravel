@extends('layout')

@section('title', 'Contacto')

@section('content')

    <div class="content">
        @if (session()->has('success'))
            <div class="success">
                {{ session('success') }}
            </div>
        @endif
        <h1>Contacto</h1>
        <form action="{{ route('messages.store') }}" method="POST">
            @csrf
            @auth
                <input type="text" name="name" placeholder="Nombre..." value="{{ old('name', auth()->user()->name) }}">
            @else
                <input type="text" name="name" placeholder="Nombre..." value="{{ old('name') }}">
            @endauth
            @error('name')
                <span class="error">{{ $message }}</span>
            @enderror
            @auth
                <input type="email" name="email" placeholder="Email..." value="{{ old('email', auth()->user()->email) }}">
            @else
                <input type="email" name="email" placeholder="Email..." value="{{ old('email') }}">
            @endauth
            @error('email')
                <span class="error">{{ $message }}</span>
            @enderror
            <input type="text" name="subject" placeholder="Asunto..." value="{{ old('subject') }}">
            @error('subject')
                <span class="error">{{ $message }}</span>
            @enderror
            <textarea name="text" placeholder="Mensaje...">{{ old('text') }}</textarea>
            @error('text')
                <span class="error">{{ $message }}</span>
            @enderror

            <input type="submit" value="Enviar">
        </form>
    </div>
@endsection
