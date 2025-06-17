@extends('layouts.menu')

@section('title', 'Listagem de Categorias')

@section('content')
    <div class="container">
        <h2 class="mb-4"><i class="bi bi-folder2-open me-2"></i>Listagem de Categorias</h2>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nome }}</td>
                        <td class="d-flex gap-2">
                            <a href="{{ route('dashboard.categorias.edit', $categoria) }}" class="btn btn-sm btn-warning" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="{{ route('dashboard.categorias.show', $categoria) }}" class="btn btn-sm btn-info text-white" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <form method="POST" action="{{ route('dashboard.categorias.destroy', $categoria) }}"
                                  onsubmit="return confirm('Tem certeza que deseja excluir esta categoria?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Nenhuma categoria cadastrada.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
