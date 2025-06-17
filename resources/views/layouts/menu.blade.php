<!DOCTYPE html>
<html lang="pt-BR">

<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Painel')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- Bootstrap e ícones -->
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

	<!-- Fonte Poppins -->
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

	<!-- Estilo Global -->
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
	</style>
</head>

<body>
	<div class="d-flex">
		<!-- Menu lateral fixo -->
		<nav class="bg-dark text-white p-3" style="width: 250px; height: 100vh; position: fixed;">
			<h4 class="mb-4">Painel</h4>
			<ul class="nav flex-column">

				<li class="nav-item">
					<a href="{{ route('dashboard.home') }}" class="nav-link text-white">
						<i class="bi bi-house-door-fill me-2"></i> Início
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('dashboard.usuarios.index') }}" class="nav-link text-white">
						<i class="bi bi-people-fill me-2"></i> Usuários
					</a>
				</li>

				<li class="nav-item">
					<a href="{{ route('dashboard.relatorios.index') }}" class="nav-link text-white">
						<i class="bi bi-bar-chart-line-fill me-2"></i> Relatórios
					</a>
				</li>

				<!-- Vendas -->
				<li class="nav-item">
					<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuVendas" role="button" aria-expanded="false" aria-controls="menuVendas">
						<i class="bi bi-clipboard-data me-2"></i> Vendas
					</a>
					<div class="collapse" id="menuVendas">
						<ul class="nav flex-column ms-3">
							<li class="nav-item">
								<a href="{{ route('dashboard.vendas.create') }}" class="nav-link text-white">
									<i class="bi bi-plus-circle me-2"></i> Cadastro
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('dashboard.vendas.index') }}" class="nav-link text-white">
									<i class="bi bi-list-ul me-2"></i> Listagem
								</a>
							</li>
						</ul>
					</div>
				</li>

				<!-- Produtos -->
				<li class="nav-item">
					<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuProdutos" role="button" aria-expanded="false" aria-controls="menuProdutos">
						<i class="bi bi-box-seam me-2"></i> Produtos
					</a>
					<div class="collapse" id="menuProdutos">
						<ul class="nav flex-column ms-3">
							<li class="nav-item">
								<a href="{{ route('dashboard.produtos.create') }}" class="nav-link text-white">
									<i class="bi bi-plus-circle me-2"></i> Cadastro
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('dashboard.produtos.index') }}" class="nav-link text-white">
									<i class="bi bi-list-ul me-2"></i> Listagem
								</a>
							</li>
						</ul>
					</div>
				</li>

				<!-- Categorias -->
				<li class="nav-item">
					<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuCategorias" role="button" aria-expanded="false" aria-controls="menuCategorias">
						<i class="bi bi-tags-fill me-2"></i> Categorias
					</a>
					<div class="collapse" id="menuCategorias">
						<ul class="nav flex-column ms-3">
							<li class="nav-item">
								<a href="{{ route('dashboard.categorias.create') }}" class="nav-link text-white">
									<i class="bi bi-plus-circle me-2"></i> Cadastro
								</a>
							</li>
							<li class="nav-item">
								<a href="{{ route('dashboard.categorias.index') }}" class="nav-link text-white">
									<i class="bi bi-list-ul me-2"></i> Listagem
								</a>
							</li>
						</ul>
					</div>
				</li>

				<li class="nav-item mt-4">
					<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger">
						<i class="bi bi-box-arrow-right me-2"></i> Sair
					</a>
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
