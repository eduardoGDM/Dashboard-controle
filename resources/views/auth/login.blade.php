@extends('layouts.app')

@section('title', 'Login')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 420px;">
        <h2 class="text-center fw-bold mb-3">Gestão de Estoque</h2>

        {{-- Alerta de sucesso após registro --}}
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        {{-- Erros de validação --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <div>{{ $error }}</div>
                @endforeach
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.login') }}">
            @csrf

            <div class="mb-3">
                <label for="email" class="form-label">Email </label>
                <input type="email" id="email" name="email" class="form-control" placeholder="Email" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" id="password" name="password" class="form-control" placeholder="Senha" required>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="remember-me" name="remember-me">
                    <label class="form-check-label" for="remember-me">Lembrar-me</label>
                </div>
                @if (Route::has('password.request'))
                    <a href="{{ route('password.request') }}" class="text-decoration-none">Esqueceu a senha?</a>
                @endif
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Entrar</button>
            </div>

            <div class="text-center">
                <span>Não tem uma conta?</span>
                <a href="{{ route('auth.register') }}" class="btn btn-outline-secondary mt-2">Registrar</a>
            </div>
        </form>
    </div>
</div>
@endsection
