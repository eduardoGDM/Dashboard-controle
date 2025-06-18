@extends('layouts.app')

@section('title', 'Cadastrar Venda (Mobile)')

@section('content')
<div class="container py-4">
    <div class="card shadow-sm">
        <div class="card-body">
            <h4 class="card-title text-center mb-4">
                <i class="bi bi-plus-circle me-2"></i>Cadastrar Venda
            </h4>

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('error'))
                <div class="alert alert-warning">
                    {{ session('error') }}
                </div>
            @endif

            <form method="POST" action="{{ route('dashboard.vendas.store') }}">
                @csrf

                <div class="mb-3">
                    <label for="nome" class="form-label">Cliente</label>
                    <input type="text" name="nome" id="nome" class="form-control" required value="{{ old('nome') }}">
                </div>

                <div class="mb-3">
                    <label for="produto_id" class="form-label">Produto</label>
                    <select name="produto_id" id="produto_id" class="form-select" required>
                        <option value="" disabled selected>Selecione um produto</option>
                        @foreach ($produtos as $produto)
                            <option value="{{ $produto->id }}" {{ old('produto_id') == $produto->id ? 'selected' : '' }}>
                                {{ $produto->nome }} - R$ {{ number_format($produto->valor, 2, ',', '.') }} ({{ $produto->quantidade }} unid)
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3">
                    <label for="quantidade" class="form-label">Quantidade</label>
                    <input type="number" name="quantidade" id="quantidade" class="form-control" min="1" required value="{{ old('quantidade', 1) }}">
                </div>

                <div class="mb-3">
                    <label for="data" class="form-label">Data da Venda</label>
                    <input type="date" name="data" id="data" class="form-control" required value="{{ old('data', date('Y-m-d')) }}">
                </div>

                <div class="mb-3">
                    <label for="status" class="form-label">Status</label>
                    <select name="status" id="status" class="form-select" required>
                        <option value="pendente" {{ old('status') == 'pendente' ? 'selected' : '' }}>Pendente</option>
                        <option value="concluída" {{ old('status') == 'concluída' ? 'selected' : '' }}>Concluída</option>
                        <option value="cancelada" {{ old('status') == 'cancelada' ? 'selected' : '' }}>Cancelada</option>
                    </select>
                </div>

                <div class="d-grid">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-save me-1"></i>Salvar Venda
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
