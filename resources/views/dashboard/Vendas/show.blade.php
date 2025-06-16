@extends('layouts.menu')

@section('title', 'Detalhes da Venda')

@section('content')
    <h2 class="mb-4">👁️ Detalhes da Venda</h2>

    <div class="card">
        <div class="card-body">
            <p><strong>Cliente:</strong> {{ $venda->nome }}</p>
            <p><strong>Produto:</strong> {{ $venda->produto->nome ?? '—' }}</p>
            <p><strong>Quantidade:</strong> {{ $venda->quantidade }}</p>
            <p><strong>Valor unitário:</strong> R$ {{ number_format($venda->valor, 2, ',', '.') }}</p>
            <p><strong>Data:</strong> {{ \Carbon\Carbon::parse($venda->data)->format('d/m/Y') }}</p>
            <p><strong>Status:</strong> {{ ucfirst($venda->status) }}</p>
        </div>
    </div>

    <a href="{{ route('dashboard.vendas.index') }}" class="btn btn-secondary mt-3">Voltar para listagem</a>
@endsection
