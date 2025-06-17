<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::all();
        return view('dashboard.usuarios.index', compact('usuarios'));
    }

    public function ativar(User $user)
    {
        $user->ativo = true;
        $user->save();

        return back()->with('success', 'Usuário ativado com sucesso!');
    }

    public function create()
    {
        return view('dashboard.usuarios.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('dashboard.usuarios.index')->with('success', 'Usuário cadastrado com sucesso.');
    }

    public function show(User $usuario)
    {
        return view('dashboard.usuarios.show', compact('usuario'));
    }

    public function edit(User $usuario)
    {
        return view('dashboard.usuarios.edit', compact('usuario'));
    }

    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|string|email|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:6',
        ]);

        $usuario->name  = $request->name;
        $usuario->email = $request->email;

        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }

        $usuario->save();

        return redirect()->route('dashboard.usuarios.index')->with('success', 'Usuário atualizado com sucesso.');
    }

    public function destroy(User $usuario)
    {
        $usuario->delete();
        return redirect()->route('dashboard.usuarios.index')->with('success', 'Usuário excluído com sucesso.');
    }
}
