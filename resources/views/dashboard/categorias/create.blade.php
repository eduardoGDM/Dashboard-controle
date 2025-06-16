@extends('layouts.menu')

@section('title', 'Cadastrar Categoria')

@section('content')
    <h2 class="mb-4">Cadastrar Categoria</h2>

   <form method="POST" action="{{ route('dashboard.categorias.store') }}">
    @csrf
    <div class="mb-3">
        <label for="nome" class="form-label">Nome da Categoria</label>
        <input type="text" id="nome" name="nome" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Salvar Categoria</button>
</form>

@endsection
