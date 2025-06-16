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

        // Vendas por produto (agrupadas)
        $dados = Venda::selectRaw('produto_id, SUM(quantidade) as total')
            ->whereMonth('data', $mesSelecionado)
            ->groupBy('produto_id')
            ->with('produto')
            ->get();

        $labels  = $dados->pluck('produto.nome');
        $valores = $dados->pluck('total');

        // Valor total vendido no mês
        $valorVendas = Venda::whereMonth('data', $mesSelecionado)->sum('valor');

        // Valor pendente (somente vendas com status pendente)
        $valorPendente = Venda::whereMonth('data', $mesSelecionado)
            ->where('status', 'pendente')
            ->sum('valor');

        // Valor dos produtos cadastrados no mês
        $valorProdutos = Produto::whereMonth('created_at', $mesSelecionado)->sum('valor');

        // Lucro estimado
        $lucro = $valorVendas - $valorProdutos;

        return view('dashboard.relatorios.index', compact(
            'labels',
            'valores',
            'valorVendas',
            'valorProdutos',
            'valorPendente',
            'lucro',
            'mesSelecionado'
        ));
    }
}
