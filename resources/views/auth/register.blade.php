@extends('layouts.app')

@section('title', 'Registrar')

@section('content')
<div class="container d-flex justify-content-center align-items-center" style="min-height: 100vh;">
    <div class="card shadow-sm p-4" style="width: 100%; max-width: 500px;">
        <h2 class="text-center fw-bold mb-3 text-primary">Criar Conta</h2>

        {{-- Mensagem de erro --}}
        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <strong>Erro!</strong> Verifique os campos abaixo:
                <ul class="mb-0 mt-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Fechar"></button>
            </div>
        @endif

        {{-- Formulário --}}
        <form method="POST" action="{{ route('auth.register') }}">
            @csrf

            <div class="mb-3">
                <label for="name" class="form-label">Nome completo</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">E-mail</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Senha</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-4">
                <label for="password_confirmation" class="form-label">Confirmar Senha</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid mb-3">
                <button type="submit" class="btn btn-primary">Registrar</button>
            </div>

            <div class="text-center">
                <small>Já possui conta? <a href="{{ route('auth.login') }}" class="text-decoration-none">Entrar</a></small>
            </div>
        </form>
    </div>
</div>
@endsection
