@extends('layouts.menu')

@section('title', 'Listagem de Usuários')

@section('content')
    <h2 class="mb-4"><i class="bi bi-people-fill me-2"></i>Listagem de Usuários</h2>

    <a href="{{ route('dashboard.usuarios.create') }}" class="btn btn-success mb-3">
        <i class="bi bi-plus-circle me-1"></i> Novo Usuário
    </a>

   <table class="table table-striped">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Email</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($usuarios as $usuario)
            <tr>
                <td>{{ $usuario->name }}</td>
                <td>{{ $usuario->email }}</td>
                <td>
                    @if($usuario->ativo)
                        <span class="badge bg-success">Ativo</span>
                    @else
                        <span class="badge bg-secondary">Inativo</span>
                    @endif
                </td>
                <td>
                    @if(!$usuario->ativo)
                        <form action="{{ route('dashboard.usuarios.ativar', $usuario) }}" method="POST">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success btn-sm">Ativar</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

@endsection
