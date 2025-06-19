<?php
namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class RelatorioController extends Controller
{
    public function grafico(Request $request)
    {
        $mesSelecionado = $request->input('mes', now()->format('m'));
        $anoSelecionado = $request->input('ano', now()->format('Y'));

        // Vendas por produto (agrupadas)
        $dados = Venda::selectRaw('produto_id, SUM(quantidade) as total')
            ->whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->groupBy('produto_id')
            ->with('produto')
            ->get();

        $labels  = $dados->pluck('produto.nome');
        $valores = $dados->pluck('total');

        // Valor total vendido no mês (produtos com listar_vendas = true)
        $valorVendas = Venda::whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->whereHas('produto', fn($query) => $query->where(['listar_vendas' => true, 'status' => 'concluída']))
            ->sum('valor');

        // Valor pendente no mês (listar_vendas = true)
        $valorPendente = Venda::whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->where('status', 'pendente')
            ->whereHas('produto', fn($query) => $query->where('listar_vendas', true))
            ->sum('valor');

        // Valor de produtos (listar_vendas = false)
        $valorProdutosMateriaPrima = Produto::where('listar_vendas', false)
            ->whereMonth('created_at', $mesSelecionado)
            ->whereYear('created_at', $anoSelecionado)
            ->sum('valor');

        // Valor de produtos de venda (listar_vendas = true)
        $valorProdutosVenda = Produto::where('listar_vendas', true)
            ->whereMonth('created_at', $mesSelecionado)
            ->whereYear('created_at', $anoSelecionado)
            ->get()
            ->sum(function ($produto) {
                return $produto->valor * $produto->quantidade;
            });

        $valorPivo = $valorProdutosMateriaPrima + $valorPendente;

        $lucro = $valorVendas - $valorPivo;

        // Vendas pendentes (para a tabela da view)
        $vendasPendentes = Venda::with('produto')
            ->whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->where('status', 'pendente')
            ->get();

        return view('dashboard.relatorios.index', compact(
            'labels',
            'valores',
            'valorVendas',
            'valorPendente',
            'valorProdutosMateriaPrima',
            'valorProdutosVenda',
            'lucro',
            'mesSelecionado',
            'anoSelecionado',
            'vendasPendentes'
        ));
    }

}
