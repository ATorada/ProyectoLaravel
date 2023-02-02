@extends('layout')

@section('title', 'Eventos')

@section('content')
    <div class="content">
        <h1>Eventos</h1>
        @forelse ($events as $event)
            @if ($loop->first)
                <ul>
            @endif
            <li>
                <a href="{{ route('events.show', $event) }}">
                    {{ $event->title }}
                </a>
            </li>
            @if ($loop->last)
                </ul>
            @endif
        @empty
            No hay eventos registrados.
        @endforelse
    </div>
@endsection
