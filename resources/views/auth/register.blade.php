@extends('layouts.app')

@section('title', 'Registrar')

@section('content')
    <div class="flex flex-col items-center justify-center min-h-screen py-10 px-4">
        <h1 class="text-3xl font-bold mb-6 text-primary">Registrar Conta</h1>

        @if ($errors->any())
            <div class="bg-red-100 text-red-700 p-4 mb-4 rounded">
                <ul class="list-disc list-inside">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('auth.register') }}" class="w-full max-w-sm bg-white p-6 rounded shadow">
            @csrf

            <label class="block mb-2 text-sm font-medium text-gray-700">Nome</label>
            <input type="text" name="name" value="{{ old('name') }}" required
                   class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">

            <label class="block mb-2 text-sm font-medium text-gray-700">Email</label>
            <input type="email" name="email" value="{{ old('email') }}" required
                   class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">

            <label class="block mb-2 text-sm font-medium text-gray-700">Senha</label>
            <input type="password" name="password" required
                   class="w-full mb-4 px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">

            <label class="block mb-2 text-sm font-medium text-gray-700">Confirmar Senha</label>
            <input type="password" name="password_confirmation" required
                   class="w-full mb-6 px-4 py-2 border rounded focus:outline-none focus:ring focus:border-blue-300">

            <button type="submit"
                    class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition">
                Registrar
            </button>
        </form>
    </div>
@endsection
