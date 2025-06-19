@extends('layouts.menu')

@section('title', 'Relatórios de Vendas')

@section('content')
    <h2 class="mb-4"><i class="bi bi-bar-chart-fill me-2"></i>Gráfico de Vendas por Produto</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="mes" class="form-select shadow-sm" onchange="this.form.submit()">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ sprintf('%02d', $m) }}" {{ $mesSelecionado == sprintf('%02d', $m) ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->locale('pt_BR')->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>

        <div class="col-md-4">
            <select name="ano" class="form-select shadow-sm" onchange="this.form.submit()">
                @for ($y = date('Y'); $y >= 2020; $y--)
                    <option value="{{ $y }}" {{ $anoSelecionado == $y ? 'selected' : '' }}>
                        {{ $y }}
                    </option>
                @endfor
            </select>
        </div>
    </form>

    <div class="mb-5" style="max-width: 700px;">
        <canvas id="graficoVendas" height="250"></canvas>
    </div>

    <div class="row g-4">
        <div class="col-md-3">
            <div class="card border-success shadow-sm h-100">
                <div class="card-body text-success">
                    <h6 class="card-title mb-2"><i class="bi bi-currency-dollar me-2"></i>Valor Total Vendido</h6>
                    <p class="fs-5 fw-bold">R$ {{ number_format($valorVendas, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

     <div class="col-md-3">
			<div class="card border-info shadow-sm h-100">
				<div class="card-body text-info">
					<h6 class="card-title mb-2"><i class="bi bi-tools me-2"></i>Produtos (Matéria-prima)</h6>
					<p class="fs-5 fw-bold">R$ {{ number_format($valorProdutosMateriaPrima, 2, ',', '.') }}</p>
				</div>
			</div>
		</div>

		<div class="col-md-3">
			<div class="card border-secondary shadow-sm h-100">
				<div class="card-body text-secondary">
					<h6 class="card-title mb-2"><i class="bi bi-tag me-2"></i>Produtos de Venda</h6>
					<p class="fs-5 fw-bold">R$ {{ number_format($valorProdutosVenda, 2, ',', '.') }}</p>
				</div>
			</div>
		</div>

        <div class="col-md-3">
            <div class="card border-danger shadow-sm h-100">
                <div class="card-body text-danger">
                    <h6 class="card-title mb-2"><i class="bi bi-exclamation-triangle-fill me-2"></i>Vendas Pendentes</h6>
                    <p class="fs-5 fw-bold">R$ {{ number_format($valorPendente, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

        <div class="col-md-3">
            <div class="card border-dark shadow-sm h-100">
                <div class="card-body text-dark">
                    <h6 class="card-title mb-2"><i class="bi bi-graph-up-arrow me-2"></i>Lucro Estimado</h6>
                    <p class="fs-5 fw-bold">R$ {{ number_format($lucro, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>

		<hr class="my-5">

<h4 class="mb-3"><i class="bi bi-hourglass-split me-2"></i>Vendas Pendentes</h4>

@if($vendasPendentes->count())
    <div class="table-responsive">
        <table class="table table-bordered table-striped align-middle shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>Nome</th>
                    <th>Produto</th>
                    <th>Valor (R$)</th>
                    <th>Quantidade</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($vendasPendentes as $venda)
                    <tr>
                        <td>{{ $venda->nome }}</td>
                        <td>{{ $venda->produto->nome ?? '—' }}</td>
                        <td>R$ {{ number_format($venda->valor, 2, ',', '.') }}</td>
                        <td>{{ $venda->quantidade }}</td>
                        <td>{{ \Carbon\Carbon::parse($venda->data)->format('d/m/Y') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@else
    <p class="text-muted">Nenhuma venda pendente neste mês.</p>
@endif

    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        const ctx = document.getElementById('graficoVendas').getContext('2d');
        const graficoVendas = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: {!! json_encode($labels) !!},
                datasets: [{
                    label: 'Quantidade Vendida',
                    data: {!! json_encode($valores) !!},
                    backgroundColor: 'rgba(54, 162, 235, 0.7)',
                    borderColor: 'rgba(54, 162, 235, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                scales: {
                    y: {
                        beginAtZero: true,
                        precision: 0,
                        title: {
                            display: true,
                            text: 'Quantidade'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Produto'
                        }
                    }
                }
            }
        });
    </script>
@endsection
