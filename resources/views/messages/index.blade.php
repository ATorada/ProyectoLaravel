@extends('layout')

@section('title', 'Mensajes')

@section('content')
    <div class="content mensajes">
        <div class="success">
            @if (session('success'))
                {{ session('success') }}
            @endif
        </div>
        <h1>Mensajes</h1>
        @forelse ($messages as $message)
            @if ($loop->first)
                <ul>
            @endif
            <li>
                @if (!$message->readed)
                    <a href="{{ route('messages.show', $message) }}" class="destacado">
                    @else
                        <a href="{{ route('messages.show', $message) }}">
                @endif
                {{ $message->name }} <br> {{ $message->subject }}
                </a>
            </li>
            @if ($loop->last)
                </ul>
            @endif
        @empty
            No hay mensajes.
        @endforelse
        <div>{{ $messages->links() }}</div>
    </div>
@endsection
