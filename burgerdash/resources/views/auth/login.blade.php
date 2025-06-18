@extends('layouts.app')

@section('title', 'Connexion Admin')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="w-full max-w-md p-8 bg-white rounded-xl shadow-lg">
        <div class="flex flex-col items-center mb-6">
            <div class="bg-secondary-500 w-16 h-16 rounded-lg flex items-center justify-center shadow-md mb-2">
                <i class="fas fa-hamburger text-primary-500 text-3xl"></i>
                            </div>
            <h1 class="text-2xl font-bold text-gray-800 mb-1">BurgerDash Admin</h1>
            <p class="text-gray-500">Connectez-vous à votre espace d'administration</p>
                        </div>
        @if ($errors->any())
            <div class="mb-4 p-3 bg-red-100 text-red-700 rounded">
                {{ $errors->first() }}
                        </div>
                                @endif
        <form method="POST" action="{{ route('login') }}" class="space-y-5">
            @csrf
            <div>
                <label for="email" class="block text-gray-700 font-medium mb-1">Email</label>
                <input id="email" type="email" name="email" required autofocus class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none">
                            </div>
            <div>
                <label for="password" class="block text-gray-700 font-medium mb-1">Mot de passe</label>
                <input id="password" type="password" name="password" required class="w-full px-4 py-2 border rounded-lg focus:ring-2 focus:ring-primary-500 focus:outline-none">
                        </div>
            <div class="flex items-center justify-between">
                <label class="flex items-center">
                    <input type="checkbox" name="remember" class="form-checkbox text-primary-500">
                    <span class="ml-2 text-gray-600 text-sm">Se souvenir de moi</span>
                </label>
                <!-- <a href="#" class="text-primary-500 text-sm hover:underline">Mot de passe oublié ?</a> -->
            </div>
            <button type="submit" class="w-full bg-primary-500 hover:bg-primary-600 text-white font-bold py-2 px-4 rounded-lg shadow transition duration-200 flex items-center justify-center">
                <i class="fas fa-sign-in-alt mr-2"></i> Connexion
            </button>
        </form>
    </div>
</div>
@endsection
