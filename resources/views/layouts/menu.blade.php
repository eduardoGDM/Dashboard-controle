<!DOCTYPE html>
<html lang="pt-BR">
<head>
	<meta charset="UTF-8">
	<title>@yield('title', 'Painel')</title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
	<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
	<style>
		body {
			font-family: 'Poppins', sans-serif;
		}
		@media (min-width: 992px) {
			#sidebar {
				position: fixed;
				top: 0;
				bottom: 0;
				width: 250px;
			}
			#main-content {
				margin-left: 250px;
			}
		}
	</style>
</head>
<body>
	<!-- Botão Hamburguer (só mobile) -->
	<nav class="navbar bg-dark d-lg-none">
		<div class="container-fluid">
			<button class="btn btn-outline-light" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar" aria-controls="sidebar">
				<i class="bi bi-list"></i> Menu
			</button>
		</div>
	</nav>

	<!-- Sidebar (offcanvas no mobile, fixo no desktop) -->
	<div class="offcanvas-lg offcanvas-start bg-dark text-white p-3" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel" style="width: 250px;">
		<h4 id="sidebarLabel" class="mb-4">Painel</h4>
		<ul class="nav flex-column">
			<li class="nav-item">
				<a href="{{ route('dashboard.home') }}" class="nav-link text-white sidebar-link"><i class="bi bi-house-door-fill me-2"></i> Início</a>
			</li>
			<li class="nav-item">
				<a href="{{ route('dashboard.usuarios.index') }}" class="nav-link text-white sidebar-link"><i class="bi bi-people-fill me-2"></i> Usuários</a>
			</li>
			<li class="nav-item">
				<a href="{{ route('dashboard.relatorios.index') }}" class="nav-link text-white sidebar-link"><i class="bi bi-bar-chart-line-fill me-2"></i> Relatórios</a>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuVendas" role="button" aria-expanded="false">
					<i class="bi bi-clipboard-data me-2"></i> Vendas
				</a>
				<div class="collapse" id="menuVendas">
					<ul class="nav flex-column ms-3">
						<li class="nav-item">
							<a href="{{ route('dashboard.vendas.create') }}" class="nav-link text-white sidebar-link"><i class="bi bi-plus-circle me-2"></i> Cadastro</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('dashboard.vendas.index') }}" class="nav-link text-white sidebar-link"><i class="bi bi-list-ul me-2"></i> Listagem</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuProdutos" role="button" aria-expanded="false">
					<i class="bi bi-box-seam me-2"></i> Produtos
				</a>
				<div class="collapse" id="menuProdutos">
					<ul class="nav flex-column ms-3">
						<li class="nav-item">
							<a href="{{ route('dashboard.produtos.create') }}" class="nav-link text-white sidebar-link"><i class="bi bi-plus-circle me-2"></i> Cadastro</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('dashboard.produtos.index') }}" class="nav-link text-white sidebar-link"><i class="bi bi-list-ul me-2"></i> Listagem</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a class="nav-link text-white" data-bs-toggle="collapse" href="#menuCategorias" role="button" aria-expanded="false">
					<i class="bi bi-tags-fill me-2"></i> Categorias
				</a>
				<div class="collapse" id="menuCategorias">
					<ul class="nav flex-column ms-3">
						<li class="nav-item">
							<a href="{{ route('dashboard.categorias.create') }}" class="nav-link text-white sidebar-link"><i class="bi bi-plus-circle me-2"></i> Cadastro</a>
						</li>
						<li class="nav-item">
							<a href="{{ route('dashboard.categorias.index') }}" class="nav-link text-white sidebar-link"><i class="bi bi-list-ul me-2"></i> Listagem</a>
						</li>
					</ul>
				</div>
			</li>
			<li class="nav-item">
				<a href="{{ route('dashboard.vendas.create-mobile') }}" class="nav-link text-white sidebar-link"><i class="bi bi-phone me-2"></i> Vendas Mobile</a>
			</li>
			<li class="nav-item mt-4">
				<a href="#" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link text-danger sidebar-link">
					<i class="bi bi-box-arrow-right me-2"></i> Sair
				</a>
				<form id="logout-form" method="POST" action="{{ route('auth.logout') }}" style="display: none;">@csrf</form>
			</li>
		</ul>
	</div>

	<!-- Conteúdo -->
	<main class="p-4" id="main-content">
		@yield('content')
	</main>

	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

	<!-- Fechar menu offcanvas ao clicar em links (mobile) -->
	<script>
		const sidebarLinks = document.querySelectorAll('.sidebar-link');
		const sidebar = document.getElementById('sidebar');
		sidebarLinks.forEach(link => {
			link.addEventListener('click', () => {
				if (sidebar.classList.contains('show')) {
					const bsOffcanvas = bootstrap.Offcanvas.getInstance(sidebar);
					bsOffcanvas.hide();
				}
			});
		});
	</script>
</body>
</html>
