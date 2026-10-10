@extends('layouts.app')
@section('title', 'Login')
@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <h1 class="text-3xl font-black mb-2">Welcome Back</h1>
    <p class="text-gray-400 mb-8">Sign in to manage your account.</p>
    @if($errors->any())<div class="bg-red-900/40 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-4">{{ $errors->first() }}</div>@endif
    <form method="POST" action="{{ route('login.attempt') }}" class="space-y-4 bg-gray-900 p-8 rounded-xl">
        @csrf
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3">
        <input type="password" name="password" placeholder="Password" required
               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3">
        <label class="flex items-center gap-2 text-sm text-gray-400">
            <input type="checkbox" name="remember"> Remember me
        </label>
        <button class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-lg font-bold">Sign In</button>
        <p class="text-center text-sm text-gray-400">No account? <a href="{{ route('register') }}" class="text-red-400">Sign up</a></p>
    </form>
</div>
@endsection
