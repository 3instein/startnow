{{-- <x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
            </a>
        </x-slot>

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <!-- Name -->
            <div>
                <x-label for="name" :value="__('Name')" />

                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus />
            </div>

            <!-- Email Address -->
            <div class="mt-4">
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-label for="password" :value="__('Password')" />

                <x-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="new-password" />
            </div>

            <!-- Confirm Password -->
            <div class="mt-4">
                <x-label for="password_confirmation" :value="__('Confirm Password')" />

                <x-input id="password_confirmation" class="block mt-1 w-full"
                                type="password"
                                name="password_confirmation" required />
            </div>

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                    {{ __('Already registered?') }}
                </a>

                <x-button class="ml-4">
                    {{ __('Register') }}
                </x-button>
            </div>
        </form>
    </x-auth-card>
</x-guest-layout> --}}
@extends('layouts.app')

@section('body')
<div class="row">
  <div class="col-md-6">
    <div class="register-form position-absolute top-50 start-50 translate-middle text-center">
      <h1 class="mb-4">Buat akun baru</h1>
      <form action="/register" method="POST">
        @csrf
        <div class="register-1">
          <div class="row mb-3">
            <div class="form-floating">
              <input type="text" name="name" class="form-control shadow-none" id="name" placeholder="full name" autocomplete="off" autofocus>
              <label for="name">Nama lengkap</label>
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-floating">
              <input type="text" name="username" class="form-control shadow-none" id="username" placeholder="full name" autocomplete="off">
              <label for="username">Username</label>
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-floating">
              <input type="email" name="email" class="form-control shadow-none" id="email" placeholder="name@example.com" autocomplete="off">
              <label for="email">Email</label>
            </div>
          </div>
          <div class="row mb-3">
            <div class="form-floating">
              <input type="password" name="password" class="form-control shadow-none" id="password" placeholder="password" autocomplete="off">
              <label for="password">Password</label>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mb-3 fw-bold bg-base-color">Daftar</button>
        </div>
      </form>
      <a href="/login" class="text-decoration-none text-dark-color">Sudah mempunyai akun? <span class="text-base-color">Masuk sekarang!</span></a>
    </div>
  </div>
</div>
@endsection