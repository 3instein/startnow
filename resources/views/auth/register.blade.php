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
    <div class="row" style="min-height: 100vh">
        <div class="col-lg-5 m-auto">
            <div class="register-form text-center">
                <h1 class="mb-4">Buat akun baru</h1>
                <form action="/register" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row mb-3">
                        <div class="form-floating">
                            <input type="text" name="name"
                                class="form-control shadow-none @error('name') is-invalid @enderror" id="name"
                                placeholder="full name" autocomplete="off" value="{{ old('name') }}" autofocus>
                            <label for="name">Nama lengkap</label>
                            @error('name')
                                <div class="text-start invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating">
                            <input type="text" name="username"
                                class="form-control shadow-none @error('username') is-invalid @enderror" id="username"
                                placeholder="full name" value="{{ old('username') }}" autocomplete="off">
                            <label for="username">Username</label>
                            @error('username')
                                <div class="text-start invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating">
                            <input type="email" name="email"
                                class="form-control shadow-none @error('username') is-invalid @enderror" id="email"
                                placeholder="name@example.com" value="{{ old('email') }}" autocomplete="off">
                            <label for="email">Email</label>
                            @error('email')
                                <div class="text-start invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-floating">
                            <input type="password" name="password"
                                class="form-control shadow-none @error('password') is-invalid @enderror" id="password"
                                placeholder="password" autocomplete="off">
                            <label for="password">Password</label>
                            @error('password')
                                <div class="text-start invalid-feedback">
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="profile_photo_path"
                            class="form-label @error('profile_photo_path') is-invalid @enderror width-100 text-start mx-0 mb-2">Foto
                            Profile</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5 border-1 d-none">
                        <input class="form-control shadow-none" type="file" id="profile_photo_path"
                            name="profile_photo_path" onchange="previewImage()">
                        @error('profile_photo_path')
                            <div class="invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-primary mb-5 fw-bold bg-base-color">Daftar</button>
                </form>
                <a href="/login" class="text-decoration-none text-dark-color">Sudah mempunyai akun? <span
                        class="text-base-color">Masuk sekarang!</span></a>
            </div>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        function previewImage() {
            const image = document.querySelector('#profile_photo_path');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.classList.remove('d-none');
            imagePreview.style.display = 'block';
            imagePreview.style.width = '128px';
            imagePreview.style.height = '128px';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(ofREvent) {
                imagePreview.src = ofREvent.target.result;
            };
        }
    </script>
@endpush
