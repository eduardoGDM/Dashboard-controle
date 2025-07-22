@extends('layouts.menu')

@section('title', 'Cadastrar Produto')

@section('content')

<script>
function formatarMoeda(campo) {
    let valor = campo.value.replace(/\D/g, '');
    valor = (parseInt(valor, 10) / 100).toFixed(2);
    campo.value = valor.replace('.', ',').replace(/\B(?=(\d{3})+(?!\d))/g, '.');
}
</script>

    <h2 class="mb-4">Cadastrar Produtos</h2>

    <form method="POST" action="{{ route('dashboard.produtos.store') }}">
        @csrf

        <div class="mb-3">
            <label for="nome" class="form-label">Nome</label>
            <input type="text" id="nome" name="nome" class="form-control" required>
        </div>

    	<div class="mb-3">
			<label for="valor" class="form-label">Valor (R$)</label>
			<input type="text" id="valor" name="valor" class="form-control" required oninput="formatarMoeda(this)">
		</div>

        <div class="mb-3">
            <label for="quantidade" class="form-label">Quantidade</label>
            <input type="number" id="quantidade" name="quantidade" class="form-control" required>
        </div>

		@if ($categorias->count())
		<div class="mb-3">
			<label for="categoria_id" class="form-label">Categoria</label>
			<select id="categoria_id" name="categoria_id" class="form-select" required>
				<option value="" disabled selected>Selecione uma categoria</option>
				@foreach ($categorias as $categoria)
					<option value="{{ $categoria->id }}">{{ $categoria->nome }}</option>
				@endforeach
			</select>
		</div>
		@endif

        <div class="mb-3">
            <label for="observacao" class="form-label">Observação</label>
            <textarea id="observacao" name="observacao" class="form-control" rows="3"></textarea>
        </div>

		<div class="form-check mb-3">
			<input type="hidden" name="listar_vendas" value="0">
			<input class="form-check-input" type="checkbox" id="listar_vendas" name="listar_vendas" value="1">
			<label class="form-check-label" for="listar_vendas">
				Listar produto para vendas
			</label>
		</div>

        <button type="submit" class="btn btn-success">Salvar Produto</button>
    </form>
@endsection
