@extends('layouts.guest')

@section('content')
    {{-- Mensaje de estado de sesión --}}
    @if (session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="custom-field form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autofocus autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" class="custom-field form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="current-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Remember me --}}
        <div class="form-check mb-3">
            <input class="custom-field custom-field-check form-check-input" type="checkbox" id="remember_me" name="remember">
            <label class="form-check-label" for="remember_me">Recordarme</label>
        </div>

        {{-- Login --}}
        <div class="d-flex justify-content-center mb-3">
            <button type="submit" class="btn custom-login">Iniciar sesión</button>
        </div>

        {{-- Forgot password --}}
        <div class="d-flex justify-content-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-decoration-none">¿Olvidaste tu contraseña?</a>
            @endif
        </div>
    </form>
@endsection
