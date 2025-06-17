<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    // Login
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => ['required', 'email'],
            'password' => ['required'],
        ]);

        if (Auth::attempt($credentials, $request->has('remember-me'))) {
            $request->session()->regenerate();

            if (! Auth::user()->ativo) {
                Auth::logout();
                return back()->withErrors([
                    'email' => 'Sua conta ainda não foi ativada por um administrador.',
                ]);
            }

            return redirect()->route('dashboard.home')->with('success', 'Login realizado com sucesso!');
        }
    }

    // Logout
    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('auth.login')->with('success', 'Você saiu da sua conta.');
    }

    public function register(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'ativo'    => false,
        ]);

        return redirect()->route('auth.login')->with('success', 'Cadastro realizado! Aguarde aprovação de um administrador para acessar a plataforma.');
    }

    public function showLoginForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.home');
        }

        return view('auth.login');
    }

    public function showRegisterForm()
    {
        if (Auth::check()) {
            return redirect()->route('dashboard.home');
        }

        return view('auth.register');
    }

}
