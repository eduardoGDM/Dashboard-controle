<?php
namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::all();
        return view('dashboard.categorias.index', compact('categorias'));
    }

    public function create()
    {
        return view('dashboard.categorias.create');
    }

    public function show(Categoria $categoria)
    {
        return view('dashboard.categorias.show', compact('categoria'));
    }

    public function edit(Categoria $categoria)
    {
        return view('dashboard.categorias.edit', compact('categoria'));
    }

    public function update(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $categoria->update([
            'nome' => $request->nome,
        ]);

        return redirect()->route('dashboard.categorias.index')->with('success', 'Categoria atualizada com sucesso!');
    }

    public function destroy(Categoria $categoria)
    {
        $categoria->delete();
        return redirect()->route('dashboard.categorias.index')->with('success', 'Categoria removida com sucesso!');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Categoria::create([
            'nome' => $request->nome,
        ]);

        return redirect()->route('dashboard.categorias.index')->with('success', 'Categoria criada com sucesso!');
    }

}
