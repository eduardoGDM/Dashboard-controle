@extends('layouts.menu')

@section('title', 'Detalhes do Usuário')

@section('content')
    <h2 class="mb-4"><i class="bi bi-person-circle me-2"></i>Usuário</h2>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $usuario->name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $usuario->email }}</p>
            <p class="card-text"><strong>Criado em:</strong> {{ $usuario->created_at->format('d/m/Y H:i') }}</p>

            <a href="{{ route('dashboard.usuarios.index') }}" class="btn btn-secondary mt-3">
                <i class="bi bi-arrow-left me-1"></i> Voltar
            </a>
        </div>
    </div>
@endsection
