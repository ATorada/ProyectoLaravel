<nav>
    <div class="logo">
        <img src="{{ asset('img/logo.svg') }}" alt="Logo">
    </div>
    <div class="menu">
        <ul>
            <li><a href="{{ route('index') }}">Inicio</a></li>
            <li><a href="{{ route('users.index') }}">Miembros</a></li>
            <li><a href="{{ route('events.index') }}">Eventos</a></li>
            <li><a href="{{ route('messages.create') }}">Contacto</a></li>
            <li><a href="{{ route('where') }}">Dónde estamos</a></li>
        </ul>
    </div>
</nav>
