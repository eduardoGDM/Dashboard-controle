@extends('layouts.menu')

@section('title', 'Editar Usuário')

@section('content')
    <h2 class="mb-4"><i class="bi bi-pencil-square me-2"></i>Editar Usuário</h2>

    <form action="{{ route('dashboard.usuarios.update', $usuario) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" value="{{ $usuario->name }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" value="{{ $usuario->email }}" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Nova Senha (opcional)</label>
            <input type="password" name="password" class="form-control">
        </div>

        <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Atualizar</button>
    </form>
@endsection
