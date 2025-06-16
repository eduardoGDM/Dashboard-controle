@extends('layouts.menu')

@section('title', 'Listagem de Vendas')

@section('content')
    <h2 class="mb-4">📈 Listagem de Vendas</h2>

    <form method="GET" action="{{ route('dashboard.vendas.index') }}" class="row g-3 mb-4">
        <div class="col-md-4">
            <input type="text" name="nome" class="form-control" placeholder="Filtrar por nome" value="{{ request('nome') }}">
        </div>

        <div class="col-md-3">
            <input type="date" name="data" class="form-control" value="{{ request('data') }}">
        </div>

        <div class="col-md-3">
            <select name="status" class="form-select">
                <option value="">Todos os status</option>
                <option value="pendente" {{ request('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="concluída" {{ request('status') == 'concluída' ? 'selected' : '' }}>Concluída</option>
                <option value="cancelada" {{ request('status') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <div class="col-md-2">
            <button type="submit" class="btn btn-primary w-100">🔍 Filtrar</button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Produto</th>
                <th>Valor (R$)</th>
                <th>Quantidade</th> <!-- NOVO -->
                <th>Status</th>
                <th>Data</th>
                <th>Ações</th>
            </tr>
        </thead>
        <tbody>
            @forelse($vendas as $venda)
                <tr>
                    <td>{{ $venda->nome }}</td>
                    <td>{{ $venda->produto->nome ?? '—' }}</td>
                    <td>R$ {{ number_format($venda->valor, 2, ',', '.') }}</td>
                    <td>{{ $venda->quantidade }}</td>
                    <td>{{ ucfirst($venda->status) }}</td>
                    <td>{{ \Carbon\Carbon::parse($venda->data)->format('d/m/Y') }}</td>

                    <td>
                        <a href="{{ route('dashboard.vendas.show', $venda->id) }}" class="btn btn-info btn-sm">👁️</a>
                        <a href="{{ route('dashboard.vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm">✏️</a>
                        <form action="{{ route('dashboard.vendas.destroy', $venda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?')">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">🗑️</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="7" class="text-center">Nenhuma venda encontrada.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
