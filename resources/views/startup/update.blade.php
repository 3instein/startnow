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
            <div class="col-md-6 mx-auto mt-4">
                <h2 class="fw-bold">Edit Profil</h2>
                <form action="{{ route('startups.update', auth()->user()->typeable) }}" enctype="multipart/form-data"
                    method="POST" class="mt-3">
                    @method('put')
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label @error('name') is-invalid @enderror ">Nama Perusahaan</label>
                        <input type="text" class="form-control shadow-none" id="name" name="name"
                            value="{{ old('name', auth()->user()->typeable->name) }}" required autofocus>
                        @error('name')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Kategori</label>
                        <select class="form-select shadow-none" name="category_id">
                            <option selected hidden>-- Choose Category --</option>
                            @foreach ($categories as $category)
                                @if (old('category_id', auth()->user()->typeable->category->id) === $category->id)
                                    <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                                @else
                                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                                @endif
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="address" class="form-label @error('address') is-invalid @enderror ">Alamat</label>
                        <input type="text" class="form-control shadow-none" id="address" name="address"
                            value="{{ old('address', auth()->user()->typeable->address) }}" required autofocus>
                        @error('address')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="contact" class="form-label @error('contact') is-invalid @enderror ">Kontak</label>
                        <input type="text" class="form-control shadow-none" id="contact" name="contact"
                            value="{{ old('contact', auth()->user()->typeable->contact) }}" required autofocus>
                        @error('contact')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="logo_path" class="form-label @error('logo_path') is-invalid @enderror ">Logo</label>
                        <img class="img-preview img-fluid mb-3 col-sm-5">
                        <input class="form-control shadow-none" type="file" id="logo_path" name="logo_path"
                            onchange="previewImage()">
                        @error('logo_path')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="about" class="form-label">Tentang Kami</label>
                        <input id="about" type="hidden" name="about"
                            value="{{ old('about', auth()->user()->typeable->about) }}">
                        <trix-editor input="about"></trix-editor>
                        @error('about')
                            <div class="text-start invalid-feedback">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>
                    <div class="d-flex justify-content-end align-items-center mb-5">
                        <a href="{{ route('ventures.index') }}" class="btn bg-base-color me-3 text-white shadow-none"
                            style="height: 36px">Kembali</a>
                        <button type="submit" class="btn bg-base-color text-white border-0 px-3">Update Profil</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons@4.28.0/dist/feather.min.js"
        integrity="sha384-uO3SXW5IuS1ZpFPKugNNWqTZRRglnUJK6UAZ/gxOX80nxEkN9NcGZTftn6RzhGWE" crossorigin="anonymous">
    </script>
    <script src="/js/dashboard.js"></script>
@endsection

@push('prepend-style')
    <link rel="stylesheet" href="{{ asset('/css/trix.css') }}">
@endpush

@push('prepend-script')
    <script src="{{ asset('/js/trix.js') }}"></script>
@endpush

@push('addon-script')
    <script>
        const title = document.querySelector('#title');
        const slug = document.querySelector('#slug');

        title.addEventListener('change', function() {
            fetch('/defineSlug?title=' + title.value)
                .then(response => response.json())
                .then(data => slug.value = data.slug);
        });

        document.addEventListener('trix-file-accept', function(e) {
            e.preventDefault();
        });

        function previewImage() {
            const image = document.querySelector('#logo_path');
            const imagePreview = document.querySelector('.img-preview');

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
