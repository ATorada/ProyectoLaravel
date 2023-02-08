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
            @auth
                <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
            @else
                <li><a href="{{ route('login') }}">Iniciar sesión</a></li>
                <li><a href="{{ route('register') }}">Registrarse</a></li>
            @endauth
            @if (auth()->check() && auth()->user()->role == 'admin')
                <li><a href="{{ route('events.create') }}">Crear evento</a></li>
                <li><a href="{{ route('messages.index') }}">Mensajes</a></li>
            @endif
        </ul>
    </div>
</nav>
