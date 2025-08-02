@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-lg shadow-lg overflow-hidden">
        <!-- Left Side - Register Form -->
        <div class="flex-1 flex flex-col justify-center px-8 py-12">
            <h1 class="text-3xl font-bold text-gray-800 mb-2 leading-tight">Create Account</h1>
            <p class="text-gray-500 mb-8 text-base">Sign up to get started</p>
            <form method="POST" action="{{ route('register') }}" class="space-y-6">
                @csrf
                <div>
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Name') }}</label>
                    <input id="name"
                           type="text"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 @error('name') border-red-400 bg-red-50 @enderror"
                           name="name"
                           value="{{ old('name') }}"
                           required
                           autocomplete="name"
                           autofocus
                           placeholder="Enter your name">
                    @error('name')
                        <span class="text-red-500 text-sm mt-1 block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address') }}</label>
                    <input id="email"
                           type="email"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 @error('email') border-red-400 bg-red-50 @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           placeholder="Enter your email">
                    @error('email')
                        <span class="text-red-500 text-sm mt-1 block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Password') }}</label>
                    <input id="password"
                           type="password"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 @error('password') border-red-400 bg-red-50 @enderror"
                           name="password"
                           required
                           autocomplete="new-password"
                           placeholder="Enter your password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
                <div>
                    <label for="password-confirm" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm"
                           type="password"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50"
                           name="password_confirmation"
                           required
                           autocomplete="new-password"
                           placeholder="Confirm your password">
                </div>
                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg text-lg transition mb-4">
                    {{ __('Register') }}
                </button>
            </form>
            <div class="text-center text-gray-500 text-sm mt-4">
                Already have an account? <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">Log in</a>
            </div>
        </div>
        <!-- Right Side - Illustration -->
        <div class="flex-1 flex items-center justify-center bg-gray-100">
            <img src="/images/login-right.png" alt="Register Illustration" class="w-full max-w-md h-auto object-cover">
        </div>
    </div>
</div>
@endsection
