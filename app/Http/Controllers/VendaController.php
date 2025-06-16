<?php
namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Http\Request;

class VendaController extends Controller
{
    public function index()
    {
        $vendas = Venda::with('produto')->get();
        return view('dashboard.vendas.index', compact('vendas'));
    }

    public function create()
    {
        $produtos = Produto::all();
        return view('dashboard.vendas.create', compact('produtos'));
    }

    public function show(Venda $venda)
    {
        return view('dashboard.vendas.show', compact('venda'));
    }

    public function edit(Venda $venda)
    {
        $produtos = Produto::all();
        return view('dashboard.vendas.edit', compact('venda', 'produtos'));
    }

    public function grafico()
    {
        $dados = \App\Models\Venda::selectRaw('produto_id, SUM(quantidade) as total')
            ->groupBy('produto_id')
            ->with('produto')
            ->get();

        $nomesProdutos       = $dados->pluck('produto.nome');
        $quantidadesVendidas = $dados->pluck('total');

        return view('dashboard.vendas.grafico', compact('nomesProdutos', 'quantidadesVendidas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome'       => 'required|string',
            'produto_id' => 'required|exists:produtos,id',
            'quantidade' => 'required|integer|min:1',
            'data'       => 'required|date',
            'status'     => 'required|string|max:255',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        if ($request->quantidade > $produto->quantidade) {
            return back()->with('error', 'Quantidade insuficiente em estoque para este produto.')->withInput();
        }

        Venda::create([
            'nome'       => $request->nome,
            'produto_id' => $produto->id,
            'valor'      => $produto->valor,
            'quantidade' => $request->quantidade,
            'data'       => $request->data,
            'status'     => $request->status,
        ]);

        $produto->decrement('quantidade', $request->quantidade);

        return redirect()->route('dashboard.vendas.index')->with('success', 'Venda registrada e estoque atualizado!');
    }

    public function update(Request $request, Venda $venda)
    {
        $request->validate([
            'nome'       => 'required|string',
            'produto_id' => 'required|exists:produtos,id',
            'data'       => 'required|date',
            'status'     => 'required|string|max:255',
            'quantidade' => 'required|integer|min:1',
        ]);

        $produto = Produto::findOrFail($request->produto_id);

        $venda->update([
            'nome'       => $request->nome,
            'produto_id' => $request->produto_id,
            'valor'      => $produto->valor,
            'data'       => $request->data,
            'status'     => $request->status,
            'quantidade' => $request->quantidade,
        ]);

        return redirect()->route('dashboard.vendas.index')->with('success', 'Venda atualizada!');
    }

    public function destroy(Venda $venda)
    {
        $venda->delete();
        return redirect()->route('dashboard.vendas.index')->with('success', 'Venda excluída!');
    }
}
