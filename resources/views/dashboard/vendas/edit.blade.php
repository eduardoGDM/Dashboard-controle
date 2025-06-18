@extends('layouts.menu')

@section('title', 'Editar Venda')

@section('content')
    <h2 class="mb-4">✏️ Editar Venda</h2>

    <form method="POST" action="{{ route('dashboard.vendas.update', $venda->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Cliente</label>
            <input type="text" id="nome" name="nome" value="{{ old('nome', $venda->nome) }}" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select id="produto_id" name="produto_id" class="form-select" required>
                <option value="" disabled>Selecione um produto</option>
                @foreach ($produtos as $produto)
                    <option value="{{ $produto->id }}" {{ $venda->produto_id == $produto->id ? 'selected' : '' }}>
                        {{ $produto->nome }} - R$ {{ number_format($produto->valor, 2, ',', '.') }}
                    </option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" class="form-control" required min="1" value="{{ old('quantidade', $venda->quantidade) }}">
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data da Venda</label>
            <input type="date" id="data" name="data" class="form-control" required value="{{ old('data', $venda->data) }}">
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select id="status" name="status" class="form-select" required>
                <option value="" disabled>Selecione o status</option>
                <option value="pendente" {{ $venda->status == 'pendente' ? 'selected' : '' }}>Pendente</option>
                <option value="concluída" {{ $venda->status == 'concluída' ? 'selected' : '' }}>Concluída</option>
                <option value="cancelada" {{ $venda->status == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Salvar Alterações</button>
    </form>
@endsection
