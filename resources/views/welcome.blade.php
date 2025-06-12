@extends('layouts.app')

@section('title', 'Bem-vindo')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen py-20 text-center px-4">
        <h1 class="text-4xl font-bold mb-4 text-primary">Bem-vindo ao {{ config('app.name', 'Laravel') }}</h1>
        <p class="text-lg text-secondary-color mb-8">Acesse sua conta ou registre-se para começar.</p>

        <div class="flex gap-4">
            <a href="{{ route('auth.login') }}"
               class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-6 rounded-lg transition">
                Login
            </a>
            <a href="{{ route('auth.register') }}"
               class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-6 rounded-lg transition">
                Registrar
            </a>
        </div>
    </div>
@endsection
