{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Remember Me -->
        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded dark:bg-gray-900 border-gray-300 dark:border-gray-700 text-indigo-600 shadow-sm focus:ring-indigo-500 dark:focus:ring-indigo-600 dark:focus:ring-offset-gray-800" name="remember">
                <span class="ms-2 text-sm text-gray-600 dark:text-gray-400">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="flex items-center justify-end mt-4">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 dark:focus:ring-offset-gray-800" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
            @endif

            <x-primary-button class="ms-3">
                {{ __('Log in') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout> --}}
@extends('layout/content')
@section('content')
@php
    $title = 'Login';
@endphp
    <!-- Login Page Container -->
    <section class="flex justify-center items-center min-h-screen bg-gray-100">
        <div class="w-full max-w-md p-8 space-y-6 bg-white rounded-lg shadow-md">
            <!-- Page Header -->
            <h2 class="text-3xl font-bold text-center text-gray-800">Log In to Your Account</h2>
            <p class="text-center text-gray-600">Access your dashboard and explore more.</p>

            <!-- Login Form -->
            <form method="POST" action="{{ route('admin.login') }}" class="space-y-6">
                @csrf

                <!-- Email Field -->
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700">Email Address</label>
                    <input id="email" type="email" name="email" required autofocus
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                        placeholder="you@example.com">
                </div>

                <!-- Password Field -->
                <div>
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" type="password" name="password" required
                        class="w-full mt-2 p-3 border border-gray-300 rounded-lg focus:ring-primary focus:border-primary"
                        placeholder="Enter your password">
                </div>

                <!-- Remember Me Checkbox -->
                <div class="flex items-center">
                    <input id="remember_me" type="checkbox" name="remember"
                        class="h-4 w-4 text-primary border-gray-300 rounded focus:ring-primary">
                    <label for="remember_me" class="ml-2 block text-sm text-gray-700">Remember Me</label>
                </div>

                <!-- Login Button -->
                <button type="submit"
                    class="w-full py-3 px-4 text-white font-semibold bg-primary rounded-lg hover:bg-accent transition">
                    Log In
                </button>

                <!-- Forgot Password Link -->
                <div class="text-center">
                    <a href="{{ route('admin.password.request') }}" class="text-sm text-primary hover:underline">Forgot
                        your password?</a>
                </div>
            </form>

            <!-- Sign Up Link -->
            <div class="text-center mt-6">
                <p class="text-sm text-gray-600">Don't have an account?
                    <a href="{{ route('admin.register') }}" class="text-primary font-semibold hover:underline">Sign Up</a>
                </p>
            </div>
        </div>
    </section>

@endsection
