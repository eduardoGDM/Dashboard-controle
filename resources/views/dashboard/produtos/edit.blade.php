@extends('layouts.menu')

@section('title', 'Editar Produto')

@section('content')
    <div class="container">
        <h2 class="mb-4">✏️ Editar Produto</h2>

        <form method="POST" action="{{ route('dashboard.produtos.update', $produto->id) }}">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" id="nome" name="nome" class="form-control" value="{{ $produto->nome }}" required>
            </div>

            <div class="mb-3">
                <label for="valor" class="form-label">Valor (R$)</label>
                <input type="number" step="0.01" id="valor" name="valor" class="form-control" value="{{ $produto->valor }}" required>
            </div>

            <div class="mb-3">
                <label for="quantidade" class="form-label">Quantidade</label>
                <input type="number" id="quantidade" name="quantidade" class="form-control" value="{{ $produto->quantidade }}" required>
            </div>

            <div class="mb-3">
                <label for="observacao" class="form-label">Observação</label>
                <textarea id="observacao" name="observacao" class="form-control" rows="3">{{ $produto->observacao }}</textarea>
            </div>

            <div class="mb-3">
                <label for="tipo" class="form-label">Tipo</label>
                <select id="tipo" name="tipo" class="form-select" required>
                    <option value="fisico" {{ $produto->tipo == 'fisico' ? 'selected' : '' }}>Físico</option>
                    <option value="digital" {{ $produto->tipo == 'digital' ? 'selected' : '' }}>Digital</option>
                    <option value="servico" {{ $produto->tipo == 'servico' ? 'selected' : '' }}>Serviço</option>
                </select>
            </div>

            @if ($categorias->count())
                <div class="mb-3">
                    <label for="categoria_id" class="form-label">Categoria</label>
                    <select id="categoria_id" name="categoria_id" class="form-select">
                        <option value="" disabled>Selecione uma categoria</option>
                        @foreach ($categorias as $categoria)
                            <option value="{{ $categoria->id }}" {{ $produto->categoria_id == $categoria->id ? 'selected' : '' }}>{{ $categoria->nome }}</option>
                        @endforeach
                    </select>
                </div>
            @endif

			<div class="form-check mb-3">
				<input type="hidden" name="listar_vendas" value="0">
				<input class="form-check-input" type="checkbox" id="listar_vendas" name="listar_vendas" value="1" {{ $produto->listar_vendas ? 'checked' : '' }}>
				<label class="form-check-label" for="listar_vendas">
					Listar produto para vendas
				</label>
			</div>

            <button type="submit" class="btn btn-primary">Salvar Alterações</button>
            <a href="{{ route('dashboard.produtos.index') }}" class="btn btn-secondary">Cancelar</a>
        </form>
    </div>
@endsection
