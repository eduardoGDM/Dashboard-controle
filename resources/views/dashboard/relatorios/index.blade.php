@extends('layouts.menu')

@section('title', 'Relatórios de Vendas')

@section('content')
    <h2 class="mb-4">📊 Gráfico de Vendas por Produto</h2>

    <form method="GET" class="row g-3 mb-4">
        <div class="col-md-4">
            <select name="mes" class="form-select" onchange="this.form.submit()">
                @for ($m = 1; $m <= 12; $m++)
                    <option value="{{ sprintf('%02d', $m) }}" {{ $mesSelecionado == sprintf('%02d', $m) ? 'selected' : '' }}>
                        {{ \Carbon\Carbon::create()->month($m)->locale('pt_BR')->translatedFormat('F') }}
                    </option>
                @endfor
            </select>
        </div>
    </form>

    <div class="mb-5" style="max-width: 700px;">
        <canvas id="graficoVendas" height="200"></canvas>
    </div>

    <div class="row">
        <div class="col-md-3">
            <div class="card border-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Valor Total Vendido</h5>
                    <p class="card-text text-success fw-bold">R$ {{ number_format($valorVendas, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Valor de Produtos</h5>
                    <p class="card-text text-primary fw-bold">R$ {{ number_format($valorProdutos, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Vendas Pendentes</h5>
                    <p class="card-text text-warning fw-bold">R$ {{ number_format($valorPendente, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card border-dark mb-3">
                <div class="card-body">
                    <h5 class="card-title">Lucro Estimado</h5>
                    <p class="card-text text-dark fw-bold">R$ {{ number_format($lucro, 2, ',', '.') }}</p>
                </div>
            </div>
        </div>
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
