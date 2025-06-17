@extends('layouts.menu')

@section('title', 'Listagem de Produtos')

@section('content')
    <div class="container">
        <h2 class="mb-4"><i class="bi bi-box-seam me-2"></i>Listagem de Produtos</h2>

        <table class="table table-striped">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Valor (R$)</th>
                    <th>Quantidade</th>
                    <th>Categoria</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($produtos as $produto)
                    <tr>
                        <td>{{ $produto->nome }}</td>
                        <td>R$ {{ number_format($produto->valor, 2, ',', '.') }}</td>
                        <td>{{ $produto->quantidade }}</td>
                        <td>{{ $produto->categoria->nome ?? '—' }}</td>
                        <td>
                            <a href="{{ route('dashboard.produtos.show', $produto->id) }}" class="btn btn-info btn-sm" title="Ver">
                                <i class="bi bi-eye"></i>
                            </a>
                            <a href="{{ route('dashboard.produtos.edit', $produto->id) }}" class="btn btn-warning btn-sm" title="Editar">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <form action="{{ route('dashboard.produtos.destroy', $produto->id) }}" method="POST" class="d-inline"
                                  onsubmit="return confirm('Tem certeza que deseja excluir este produto?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm" title="Excluir">
                                    <i class="bi bi-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" class="text-center">Nenhum produto encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
