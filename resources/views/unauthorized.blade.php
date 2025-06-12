@extends('layouts.app')

@section('title', 'Acesso Negado')

@section('content')
    <div class="min-h-screen flex items-center justify-center text-center px-4">
        <div class="max-w-xl">
            <h1 class="text-4xl font-bold text-red-600 mb-4">Acesso Negado</h1>
            <p class="text-gray-700 text-lg mb-6">Você não possui autorização para acessar esta página.</p>

            <a href="{{ route('auth.login') }}"
               class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Fazer Login
            </a>
        </div>
    </div>
@endsection
