{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
@extends('layouts.app')

@section('body')
    <div class="login-form position-absolute top-50 start-50 translate-middle text-center">
        <h1>Selamat Datang</h1>
        <p class="mb-5">Masuk ke dalam akun Anda dan ikut serta dalam<br />perkembangan start-up di Indonesia</p>
        <form>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com">
                    <label for="email">Email</label>
                </div>
            </div>
            <div class="row">
                <div class="form-floating">
                    <input type="password" name="password" class="form-control" id="password" placeholder="name@example.com">
                    <label for="password">Password</label>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center login-optional">
                <label for="remember_me" class="inline-flex items-center ms-0">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" name="remember">
                    <span class="ml-2 text-sm text-gray-600">{{ __('Ingat saya') }}</span>
                </label>
                <a href="" class="text-decoration-none text-dark-color">Lupa Password?</a>
            </div>
            <button type="submit" class="btn btn-primary mb-5 bg-base-color">Masuk</button>
          </form>
          <a href="/register" class="text-decoration-none text-dark-color">Belum mempunyai akun? <span class="text-base-color">Buat sekarang!</span></a>
        </div>
@endsection