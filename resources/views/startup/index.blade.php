@extends('layouts.app')

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

    </style>
    <link rel="stylesheet" href="/css/dashboard.css">
@endpush

@if (!auth()->user()->typeable_id)
    @section('body')
        <div class="register-company position-absolute top-50 start-50 translate-middle text-center col-lg-3">
            <h1 class="fs-1">Bergabunglah dengan komunitas startup kami.</h1>
            <p class="mb-5">Berkolaborasi dan berbagi ide bisnis</p>
            <form action="" method="POST" id="business-form">
                @csrf
                <div class="row mb-3">
                    <div class="form-floating">
                        <input type="text" name="name" name="name" class="form-control shadow-none" id="name"
                            placeholder="name@example.com" autofocus autocomplete="off">
                        <label for="name">Nama start up</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="dropdown">
                        <select class="form-select shadow-none py-3" name="category_id" aria-label="Default select example">
                            <option selected hidden>Bidang start up</option>
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-floating">
                        <input type="text" name="address" name="address" class="form-control shadow-none" id="address"
                            placeholder="name@example.com" autocomplete="off">
                        <label for="address">Alamat kantor</label>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="form-floating">
                        <input type="number" name="contact" name="contact" class="form-control shadow-none" id="contact"
                            placeholder="name@example.com" autocomplete="off">
                        <label for="contact">Nomor telepon kantor</label>
                    </div>
                </div>
                <div class="mb-3">
                    <label for="about" class="form-label text-start width-100 mx-0 mb-2">Tentang Kami</label>
                    <input id="about" type="hidden" name="about" value="{{ old('about') }}">
                    <trix-editor input="about" class="text-start"></trix-editor>
                </div>
                <div class="btn-group width-100 mb-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="radio" class="btn-check" name="type-radio" id="startup-radio" autocomplete="off"
                        value="startup" data-value="{{ route('startups.store') }}">
                    <label class="btn btn-outline-primary m-0" for="startup-radio">Startups</label>
                    <input type="radio" class="btn-check" name="type-radio" id="venture-radio" autocomplete="off"
                        value="venture" data-value="{{ route('ventures.store') }}">
                    <label class="btn btn-outline-primary m-0" for="venture-radio">Perusahaan</label>
                </div>
                <button type="submit" class="btn btn-primary mb-5 bg-base-color fw-bold border-0" id="gabung">Gabung
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
                    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 mb-5">
                        <div class="d-flex align-items-center">
                            <img src="https://source.unsplash.com/120x120"
                                style="width: 120px; height: 120px; object-fit: contain; border-radius: 10%">
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
        $('input[type="radio"][name="type-radio"]').change(function(e) {
            e.preventDefault();
            let url = $('input[type="radio"][name="type-radio"]:checked').data('value');
            $('#business-form').attr('action', url);
        });
    </script>
@endpush

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
@endpush

@push('prepend-script')
    <script src="{{ asset('/js/trix.js') }}"></script>
@endpush
