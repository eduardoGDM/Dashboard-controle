@extends('layouts.menu')

@section('title', 'Visualizar Categoria')

@section('content')
    <h2 class="mb-4">Detalhes da Categoria</h2>

    <ul class="list-group">
        <li class="list-group-item"><strong>ID:</strong> {{ $categoria->id }}</li>
        <li class="list-group-item"><strong>Nome:</strong> {{ $categoria->nome }}</li>
        <li class="list-group-item"><strong>Criado em:</strong> {{ $categoria->created_at->format('d/m/Y H:i') }}</li>
    </ul>

    <a href="{{ route('dashboard.categorias.index') }}" class="btn btn-secondary mt-3">Voltar</a>
@endsection
