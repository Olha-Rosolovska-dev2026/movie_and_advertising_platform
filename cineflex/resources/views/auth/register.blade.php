@extends('layouts.app')
@section('title', 'Sign Up')
@section('content')
<div class="max-w-md mx-auto px-4 py-16">
    <h1 class="text-3xl font-black mb-2">Create Account</h1>
    <p class="text-gray-400 mb-8">Join CineFlex to watch and purchase movies.</p>
    @if($errors->any())<div class="bg-red-900/40 border border-red-600 text-red-200 px-4 py-3 rounded-lg mb-4"><ul>@foreach($errors->all() as $e)<li>{{ $e }}</li>@endforeach</ul></div>@endif
    <form method="POST" action="{{ route('register.attempt') }}" class="space-y-4 bg-gray-900 p-8 rounded-xl">
        @csrf
        <input type="text" name="name" value="{{ old('name') }}" placeholder="Full Name" required
               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3">
        <input type="email" name="email" value="{{ old('email') }}" placeholder="Email" required
               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3">
        <input type="password" name="password" placeholder="Password (min 8 characters)" required
               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3">
        <input type="password" name="password_confirmation" placeholder="Confirm Password" required
               class="w-full bg-gray-800 border border-gray-700 rounded-lg px-4 py-3">
        <button class="w-full bg-red-600 hover:bg-red-700 py-3 rounded-lg font-bold">Create Account</button>
        <p class="text-center text-sm text-gray-400">Already registered? <a href="{{ route('login') }}" class="text-red-400">Sign in</a></p>
    </form>
</div>
@endsection
