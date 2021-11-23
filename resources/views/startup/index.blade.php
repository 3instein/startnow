@extends('layouts.app')

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
@endpush

@push('addon-style')
    <style>
        #phone_number::-webkit-outer-spin-button,
        #phone_number::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .navbar-brand {
            background-color: #fff !important;
            box-shadow: none !important;
        }

        .selected {
            background-color: #0471a6;
            border: 1px solid #0471a6;
            color: #fff !important;
        }

        .selected:hover {
            background-color: #0471a6;
            border: 1px solid #0471a6;
            color: #fff;
        }

        .btn-outline-base {
            border: 1px solid #0471a6;
            color: #0471a6;
        }

    </style>
    <link rel="stylesheet" href="/css/dashboard.css">
@endpush

@if (!auth()->user()->typeable_id)
    @section('body')
        <div class="register-company position-absolute top-50 start-50 translate-middle text-center col-lg-3">
            <h1 class="fs-1">Bergabunglah dengan komunitas startup kami.</h1>
            <p class="mb-5">Berkolaborasi dan berbagi ide bisnis</p>
            <form action="" method="POST" id="business-form" enctype="multipart/form-data">
                @csrf
                <div class="mb-3 d-flex">
                    <div class="form-floating width-100 me-3">
                        <input type="text" name="name" name="name"
                            class="form-control shadow-none @error('name') is-invalid @enderror" id="name"
                            placeholder="name@example.com" autofocus autocomplete="off" value="{{ old('name') }}">
                        <label for="name">Nama start up</label>
                        @error('name')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="form-floating width-100">
                        <input type="number" name="contact" name="contact"
                            class="form-control shadow-none  @error('contact') is-invalid @enderror" id="contact"
                            placeholder="name@example.com" autocomplete="off" value="{{ old('contact') }}">
                        <label for="contact">Nomor telepon kantor</label>
                        @error('contact')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="dropdown">
                        <select class="form-select shadow-none py-3" name="category_id" aria-label="Default select example"
                            required>
                            <option selected hidden>Bidang start up</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-floating">
                        <input type="text" name="address" name="address"
                            class="form-control shadow-none  @error('address') is-invalid @enderror" id="address"
                            placeholder="name@example.com" autocomplete="off" value="{{ old('address') }}">
                        <label for="address">Alamat kantor</label>
                        @error('address')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                </div>
                <div class="mb-3">
                    <label for="logo_path" class="form-label text-start width-100 mx-0 mb-2">Logo Perusahaan</label>
                    <img class="img-preview img-fluid d-none col-sm-5">
                    <input class="form-control shadow-none" type="file" id="logo_path" name="logo_path"
                        onchange="previewImage()">
                    @error('logo_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="about" class="form-label text-start width-100 mx-0 mb-2">Tentang Kami</label>
                    <input id="about" type="hidden" name="about" value="{{ old('about') }}">
                    <trix-editor input="about" class="text-start"></trix-editor>
                    @error('about')
                        <div class="text-start invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="btn-group width-100 mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="type-radio" id="startup-radio" autocomplete="off"
                        value="startup" data-value="{{ route('startups.store') }}">
                    <label class="btn btn-outline-base m-0 shadow-none" for="startup-radio">Startups</label>
                    <input type="radio" class="btn-check" name="type-radio" id="venture-radio" autocomplete="off"
                        value="venture" data-value="{{ route('ventures.store') }}">
                    <label class="btn btn-outline-base m-0 shadow-none" for="venture-radio">Perusahaan</label>
                </div>
                <button type="button" class="btn btn-primary mb-5 bg-base-color fw-bold border-0 width-100" id="gabung">Gabung
                    Sekarang</button>
            </form>
        </div>
    @endsection
@else
    @section('dashboard')
        @include('startup.components.navigation')
        <div class="container-fluid">
            <div class="row">
                @include('startup.components.sidebar')
                <main class="col-md-9 mx-auto">
                    @if (session()->has('success'))
                        <div class="alert alert-success alert-dismissible mt-3" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 mb-5">
                        <div class="d-flex align-items-center">
                            <img src="{{ auth()->user()->typeable->logo_path }}"
                                style="width: 120px; height: 120px; object-fit: contain; border-radius: 10%"
                                class="border">
                            <div class="d-flex flex-column ms-4">
                                <h1 class="fw-bold">{{ auth()->user()->typeable->name }}</h1>
                                <p class="fw-bold">{{ auth()->user()->typeable->category->name }}</p>
                            </div>
                        </div>
                    </div>
                    <h3 class="fw-bold border-bottom pb-3">Gambaran Singkat</h3>
                    <div class="mt-3">
                        <h5>Lorem ipsum dolor sit amet consectetur adipisicing elit.</h5> {{-- slogan --}}
                        <p>{!! auth()->user()->typeable->about !!}</p>
                    </div>
                    <h6>Alamat: {{ auth()->user()->typeable->address }}</h6>
                    <h6>Kontak: {{ auth()->user()->typeable->contact }}</h6>
                </main>
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
                integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
        </script>
        <script src="/js/dashboard.js"></script>
    @endsection
@endif

@push('addon-script')
    <script>
        let form = $('#business-form');
        $('#gabung').click(function() {
            if (form.attr('action') != '') {
                form.submit();
            } else {
                alert('Tipe perusahaan tidak boleh kosong');
            }
        });
        
        $('input[type="radio"][name="type-radio"]').change(function(e) {
            e.preventDefault();
            let url = $('input[type="radio"][name="type-radio"]:checked').data('value');
            $('#business-form').attr('action', url);
        });

        const radios = $('input[name="type-radio"]');
        for (const radio of radios) {
            radio.addEventListener('click', function() {
                if (radio.value === 'startup') {
                    $('label[for="startup-radio"]').addClass('selected');
                    $('label[for="venture-radio"]').removeClass('selected');
                } else {
                    $('label[for="startup-radio"]').removeClass('selected');
                    $('label[for="venture-radio"]').addClass('selected');
                }
            });
        }

        function previewImage() {
            const image = document.querySelector('#logo_path');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.classList.remove('d-none');
            imagePreview.classList.add('mb-3');
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

@push('prepend-script')
    <script src="{{ asset('/js/trix.js') }}"></script>
@endpush
