{{-- NAVBAR responsive --}}
<nav class="navbar navbar-expand-lg custom-nav py-0">
    {{-- Centramos el nav --}}
    <div class="container">
        {{-- Logo + redirección a inicio --}}
        <a class="navbar-brand" href="{{ url('/') }}">
            <img src="https://pbs.twimg.com/profile_images/947504948765450240/nZtFY4Lb_400x400.jpg"
                class="rounded-circle custom-nav-logo">
        </a>
        {{-- Toggler para móviles --}}
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            {{-- Menú TIENDA --}}
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{ request()->is('/') ? 'custom-active-link' : '' }}" href="{{ url('/') }}">
                        <i class="fa-solid fa-house"></i>
                    </a>
                </li>
                @auth
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('productos') ? 'custom-active-link' : '' }}"
                            href="{{ url('/productos') }}">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('pedidos') ? 'custom-active-link' : '' }}"
                            href="{{ url('/pedidos') }}">Pedidos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link {{ request()->is('clientes') ? 'custom-active-link' : '' }}"
                            href="{{ url('/clientes') }}">Clientes</a>
                    </li>
                @endauth
            </ul>
            {{-- Menú ADMIN --}}
            <ul class="navbar-nav ms-auto">
                @can('gestionar-productos')
                    <li class="nav-item">
                        <a class="nav-link" href="#">Panel de admin</a>
                    </li>
                @endcan

                @auth
                    <li class="nav-item">
                        <a class="nav-link" href="#">{{ Auth::user()->name }}</a>
                    </li>
                    <li class="nav-item">
                        <form action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link">Salir</button>
                        </form>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('login') }}">Iniciar Sesión</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('register') }}">Registrarse</a>
                    </li>
                @endauth
            </ul>
        </div>
    </div>
</nav>
