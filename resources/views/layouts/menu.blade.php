<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Painel')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
	<div class="d-flex">
		<!-- Menu lateral fixo -->
		<nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh; position: fixed;">
			<h4 class="mb-4">Painel</h4>
			<ul class="nav flex-column">

				<li class="nav-item">
					<a href="{{ route('dashboard.home') }}" class="nav-link text-white">🏠 Início</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('dashboard.usuarios') }}" class="nav-link text-white">👤 Usuários</a>
				</li>

				<li class="nav-item">
   					<a href="{{ route('dashboard.relatorios.index') }}" class="nav-link text-white">📊 Relatórios</a>
				</li>

				<!-- Vendas com dropdown -->
				<li class="nav-item">
					<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuVendas" role="button" aria-expanded="false" aria-controls="menuVendas">
						🗂️ Vendas
					</a>
					<div class="collapse" id="menuVendas">
						<ul class="nav flex-column ms-3">
							<li class="nav-item">
								<a href="{{ route('dashboard.vendas.create') }}" class="nav-link text-white">+ Cadastro</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('dashboard.vendas.index') }}" class="nav-link text-white">📋 Listagem</a>
							</li>
						</ul>
					</div>
				</li>

				<!-- Produtos com dropdown -->
				<li class="nav-item">
					<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuProdutos" role="button" aria-expanded="false" aria-controls="menuProdutos">
						📦 Produtos
					</a>
					<div class="collapse" id="menuProdutos">
						<ul class="nav flex-column ms-3">
							<li class="nav-item">
								<a href="{{ route('dashboard.produtos.create') }}" class="nav-link text-white">+ Cadastro</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('dashboard.produtos.index') }}" class="nav-link text-white">📋 Listagem</a>
							</li>
						</ul>
					</div>
				</li>

				<!-- Categorias com dropdown -->
				<li class="nav-item">
					<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuCategorias" role="button" aria-expanded="false" aria-controls="menuCategorias">
						🗂️ Categorias
					</a>
					<div class="collapse" id="menuCategorias">
						<ul class="nav flex-column ms-3">
							<li class="nav-item">
								<a href="{{ route('dashboard.categorias.create') }}" class="nav-link text-white">+ Cadastro</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('dashboard.categorias.index') }}" class="nav-link text-white">📋 Listagem</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item mt-4">
					<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger">🚪 Sair</a>
					<form id="logout-form" method="POST" action="{{ route('auth.logout') }}" style="display: none;">
						@csrf
					</form>
				</li>
			</ul>
		</nav>

		<!-- Conteúdo da página -->
		<main class="flex-grow-1 ms-250" style="margin-left: 250px; padding: 30px;">
			@yield('content')
		</main>
	</div>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
