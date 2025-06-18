@extends('layouts.menu')

@section('title', 'Listagem de Vendas')

@section('content')
    <h2 class="mb-4"><i class="bi bi-clipboard-data me-2"></i>Listagem de Vendas</h2>

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
            <button type="submit" class="btn btn-primary w-100">
                <i class="bi bi-search me-1"></i> Filtrar
            </button>
        </div>
    </form>

    <table class="table table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Nome</th>
                <th>Produto</th>
                <th>Valor (R$)</th>
                <th>Quantidade</th>
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
					<a href="{{ route('dashboard.vendas.show', $venda->id) }}" class="btn btn-info btn-sm" title="Visualizar">
						<i class="bi bi-eye"></i>
					</a>
					<a href="{{ route('dashboard.vendas.edit', $venda->id) }}" class="btn btn-warning btn-sm" title="Editar">
						<i class="bi bi-pencil"></i>
					</a>

					<form action="{{ route('dashboard.vendas.destroy', $venda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Tem certeza que deseja excluir esta venda?')">
						@csrf
							@method('DELETE')
						<button type="submit" class="btn btn-danger btn-sm" title="Excluir">
							<i class="bi bi-trash"></i>
						</button>
					</form>

    @if($venda->status === 'pendente')
        <form action="{{ route('dashboard.vendas.aprovar', $venda->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Deseja realmente aprovar esta venda?')">
            @csrf
            <button type="submit" class="btn btn-success btn-sm" title="Aprovar Venda">
                <i class="bi bi-check-circle"></i>
            </button>
        </form>
    @endif
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
