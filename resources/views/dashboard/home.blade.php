@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <div class="p-10">
        <h1 class="text-3xl font-bold text-primary">Bem-vindo</h1>
        <p class="mt-2 text-gray-600">Você está logado com sucesso.</p>

        <form method="POST" action="{{ route('auth.logout') }}" class="mt-6">
            @csrf
            <button type="submit"
                class="bg-red-600 hover:bg-red-700 text-white font-semibold px-4 py-2 rounded">
                Sair
            </button>
        </form>
    </div>
@endsection
