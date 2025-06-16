@extends('layouts.menu')

@section('title', 'Editar Categoria')

@section('content')
    <h2 class="mb-4">Editar Categoria</h2>

    <form method="POST" action="{{ route('dashboard.categorias.update', $categoria) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="nome" class="form-label">Nome da Categoria</label>
            <input type="text" id="nome" name="nome" class="form-control" value="{{ $categoria->nome }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Atualizar Categoria</button>
    </form>
@endsection
