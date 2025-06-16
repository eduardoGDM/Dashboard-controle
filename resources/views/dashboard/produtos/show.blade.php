@extends('layouts.menu')

@section('title', 'Visualizar Produto')

@section('content')
    <div class="container">
        <h2 class="mb-4">👁️ Visualizar Produto</h2>

        <div class="mb-3">
            <strong>Nome:</strong>
            <p>{{ $produto->nome }}</p>
        </div>

        <div class="mb-3">
            <strong>Valor (R$):</strong>
            <p>R$ {{ number_format($produto->valor, 2, ',', '.') }}</p>
        </div>

        <div class="mb-3">
            <strong>Quantidade:</strong>
            <p>{{ $produto->quantidade }}</p>
        </div>

        <div class="mb-3">
            <strong>Observação:</strong>
            <p>{{ $produto->observacao }}</p>
        </div>

        <div class="mb-3">
            <strong>Tipo:</strong>
            <p>{{ ucfirst($produto->tipo) }}</p>
        </div>

        <div class="mb-3">
            <strong>Categoria:</strong>
            <p>{{ $produto->categoria->nome ?? '—' }}</p>
        </div>

        <a href="{{ route('dashboard.produtos.index') }}" class="btn btn-secondary">Voltar</a>
    </div>
@endsection
