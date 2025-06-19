<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Produto;
use Illuminate\Http\Request;

class ProdutoController extends Controller
{
    public function index()
    {
        $produtos = Produto::with('categoria')->get();
        return view('dashboard.produtos.index', compact('produtos'));
    }

    public function create()
    {
        $categorias = Categoria::all();
        return view('dashboard.produtos.create', compact('categorias'));
    }

    public function show(Produto $produto)
    {
        return view('dashboard.produtos.show', compact('produto'));
    }

    public function edit(Produto $produto)
    {
        $categorias = Categoria::all();
        return view('dashboard.produtos.edit', compact('produto', 'categorias'));
    }

    public function destroy(Produto $produto)
    {
        $produto->delete();

        return redirect()->route('dashboard.produtos.index')->with('success', 'Produto excluído com sucesso!');
    }

    public function store(Request $request)
    {
        try {
            info('Recebido:', $request->all());

            $valorConvertido = str_replace(['.', ','], ['', '.'], $request->valor);
            $request->merge(['valor' => $valorConvertido]);

            $request->validate([
                'nome'          => 'required',
                'valor'         => 'required|numeric',
                'quantidade'    => 'required|integer',
                'observacao'    => 'nullable|string',
                'listar_vendas' => 'required|required',
                'categoria_id'  => 'nullable|numeric',
            ]);

            Produto::create([
                'nome'          => $request->nome,
                'valor'         => $request->valor,
                'quantidade'    => $request->quantidade,
                'observacao'    => $request->observacao,
                'listar_vendas' => $request->listar_vendas,
                'categoria_id'  => $request->categoria_id,
            ]);

            return redirect()->route('dashboard.produtos.index')->with('success', 'Produto cadastrado com sucesso!');
        } catch (\Throwable $e) {
            \Log::error('Erro ao salvar produto', ['erro' => $e->getMessage()]);
            return back()->with('error', 'Erro ao salvar produto.')->withInput();
        }
    }

    public function update(Request $request, Produto $produto)
    {
        $request->validate([
            'nome'          => 'required|string|max:255',
            'valor'         => 'required|numeric',
            'quantidade'    => 'required|integer',
            'observacao'    => 'nullable|string',
            'listar_vendas' => 'required|required',
            'categoria_id'  => 'nullable|exists:categorias,id',
        ]);

        $produto->update([
            'nome'          => $request->nome,
            'valor'         => $request->valor,
            'quantidade'    => $request->quantidade,
            'observacao'    => $request->observacao,
            'listar_vendas' => $request->listar_vendas,
            'categoria_id'  => $request->categoria_id,
        ]);

        return redirect()->route('dashboard.produtos.index')->with('success', 'Produto atualizado com sucesso!');
    }

}
