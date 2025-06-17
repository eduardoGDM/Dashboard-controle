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

        // Valor total vendido no mês e ano
        $valorVendas = Venda::whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->sum('valor');

        // Valor pendente no mês e ano
        $valorPendente = Venda::whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->where('status', 'pendente')
            ->sum('valor');

        // Produtos cadastrados no mês e ano
        $valorProdutos = Produto::whereMonth('created_at', $mesSelecionado)
            ->whereYear('created_at', $anoSelecionado)
            ->sum('valor');

        // Lucro estimado
        $lucro = $valorVendas - $valorProdutos;

        $vendasPendentes = Venda::with('produto')
            ->whereMonth('data', $mesSelecionado)
            ->whereYear('data', $anoSelecionado)
            ->where('status', 'pendente')
            ->get();

        return view('dashboard.relatorios.index', compact(
            'labels',
            'valores',
            'valorVendas',
            'valorProdutos',
            'valorPendente',
            'lucro',
            'mesSelecionado',
            'anoSelecionado',
            'vendasPendentes'
        ));
    }
}
