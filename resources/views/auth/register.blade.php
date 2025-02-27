@extends('layouts.guest')

@section('content')
    <form method="POST" action="{{ route('register') }}">
        @csrf

        {{-- Name --}}
        <div class="mb-3">
            <label for="name" class="form-label">Nombre</label>
            <input id="name" type="text" class="custom-field form-control @error('name') is-invalid @enderror" name="name"
                value="{{ old('name') }}" required autofocus autocomplete="name">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Email --}}
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input id="email" type="email" class="custom-field form-control @error('email') is-invalid @enderror" name="email"
                value="{{ old('email') }}" required autocomplete="username">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Password --}}
        <div class="mb-3">
            <label for="password" class="form-label">Contraseña</label>
            <input id="password" type="password" class="custom-field form-control @error('password') is-invalid @enderror"
                name="password" required autocomplete="new-password">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Confirm --}}
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
            <input id="password_confirmation" type="password" class="custom-field form-control" name="password_confirmation" required
                autocomplete="new-password">
        </div>

        {{-- Register --}}
        <div class="d-flex justify-content-center mb-3">
            <button type="submit" class="btn custom-register">Registrarse</button>
        </div>

        {{-- Have account --}}
        <div class="d-flex justify-content-center">
            <a href="{{ route('login') }}" class="text-decoration-none">¿Ya tienes cuenta?</a>
        </div>
    </form>
@endsection
