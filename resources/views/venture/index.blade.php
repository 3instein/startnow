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

@section('dashboard')
    @include('venture.components.navigation')
    <div class="container-fluid">
        <div class="row">
            @include('venture.components.sidebar')
            <main class="col-md-9 mx-auto">
                @if (session()->has('success'))
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        {{ session('success') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center mt-3 mb-5">
                    <div class="d-flex align-items-center">
                        <img src="{{ Storage::url(auth()->user()->typeable->logo_path) }}"
                            style="width: 120px; height: 120px; object-fit: contain; border-radius: 10%"
                            class="border">
                        <div class="d-flex flex-column ms-4">
                            <h1 class="fw-bold">{{ auth()->user()->typeable->name }}</h1>
                            <p class="fw-bold">{{ auth()->user()->typeable->category->name }}</p>
                        </div>
                    </div>
                </div>
                <h3 class="fw-bold border-bottom pb-3">Tentang Kami</h3>
                <div class="mt-3">
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

@push('addon-script')
    <script>
        $('input[type="radio"][name="type-radio"]').change(function(e) {
            e.preventDefault();
            let url = $('input[type="radio"][name="type-radio"]:checked').data('value');
            $('#business-form').attr('action', url);
        });
    </script>
@endpush
