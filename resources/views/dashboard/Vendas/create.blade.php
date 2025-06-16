@extends('layouts.menu')

@section('title', 'Registrar Venda')

@section('content')
    <h2 class="mb-4">Registrar Venda</h2>

    <form method="POST" action="{{ route('dashboard.vendas.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Cliente</label>
            <input type="text" name="nome" id="nome" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="produto_id" class="form-label">Produto</label>
            <select name="produto_id" id="produto_id" class="form-select" required>
                <option value="" selected disabled>Selecione um produto</option>
                @foreach($produtos as $produto)
                    <option value="{{ $produto->id }}">{{ $produto->nome }} - R$ {{ number_format($produto->valor, 2, ',', '.') }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label for="data" class="form-label">Data da Venda</label>
            <input type="date" name="data" id="data" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status" class="form-label">Status</label>
            <select name="status" id="status" class="form-select" required>
                <option value="" selected disabled>Selecione o status</option>
                <option value="pendente">Pendente</option>
                <option value="concluída">Concluída</option>
                <option value="cancelada">Cancelada</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Registrar Venda</button>
    </form>
@endsection
