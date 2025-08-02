@extends('layouts.app')

@section('content')
<div class="flex items-center justify-center min-h-screen bg-gray-50 overflow-hidden">
    <div class="flex flex-col md:flex-row w-full max-w-4xl bg-white rounded-lg shadow-lg">
        <!-- Left Side - Login Form -->
        <div class="flex-1 flex flex-col justify-center px-8 py-8">
            <h1 class="text-3xl font-bold text-gray-800 mb-2 leading-tight">Welcome Back</h1>
            <p class="text-gray-500 mb-8 text-base">Please sign in to your account</p>

            <form method="POST" action="{{ route('login') }}" class="space-y-6">
                @csrf

                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-2">{{ __('Email Address') }}</label>
                    <input id="email"
                           type="email"
                           class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg text-base focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 bg-gray-50 @error('email') border-red-400 bg-red-50 @enderror"
                           name="email"
                           value="{{ old('email') }}"
                           required
                           autocomplete="email"
                           autofocus
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
                           autocomplete="current-password"
                           placeholder="Enter your password">
                    @error('password')
                        <span class="text-red-500 text-sm mt-1 block" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="flex items-center justify-between mb-6">
                    <div class="flex items-center">
                        <input class="w-4 h-4 text-indigo-600 border-gray-300 rounded focus:ring-indigo-500 mr-2" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="text-sm text-gray-500 cursor-pointer" for="remember">
                            {{ __('Keep me logged in') }}
                        </label>
                    </div>

                    @if (Route::has('password.request'))
                        <a class="text-indigo-600 hover:underline text-sm font-medium" href="{{ route('password.request') }}">
                            {{ __('Forgot your password?') }}
                        </a>
                    @endif
                </div>

                <button type="submit" class="w-full bg-indigo-600 hover:bg-indigo-700 text-white font-semibold py-3 rounded-lg text-lg transition mb-4">
                    {{ __('Log In') }}
                </button>
            </form>

            <div class="text-center text-gray-500 text-sm mt-4">
                Don't have an account? <a href="{{ route('register') }}" class="text-indigo-600 hover:underline font-medium">Sign up</a>
            </div>
        </div>
        <!-- Right Side - Illustration -->
        <div class="flex-1 flex items-center justify-center bg-gray-100">
            <img src="/images/login-right.png" alt="Login Illustration" class="w-full max-w-md h-auto object-cover">
        </div>
    </div>
</div>
@endsection