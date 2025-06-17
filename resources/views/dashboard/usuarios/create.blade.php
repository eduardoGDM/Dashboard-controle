@extends('layouts.menu')

@section('title', 'Cadastrar Usuário')

@section('content')
    <h2 class="mb-4"><i class="bi bi-person-plus-fill me-2"></i>Novo Usuário</h2>

    <form action="{{ route('dashboard.usuarios.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label class="form-label">Nome</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Senha</label>
            <input type="password" name="password" class="form-control" required>
        </div>

        <button class="btn btn-primary"><i class="bi bi-save me-1"></i>Salvar</button>
    </form>
@endsection
