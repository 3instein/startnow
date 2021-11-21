@extends('index')

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
            const image = document.querySelector('#thumbnail_path');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(ofREvent) {
                imagePreview.src = ofREvent.target.result;
            };
        }
    </script>
@endpush

@section('post')
    <div class="row mt-5">
        <div class="col-lg-10 mx-auto">
            <h2 class="fw-bolder">Edit Post</h2>
            <form action="{{ route('posts.update', $post) }}" class="mt-3" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label @error('title') is-invalid @enderror ">Judul</label>
                    <input type="text" class="form-control shadow-none" id="title" name="title"
                        value="{{ old('title', $post->title) }}" required autofocus>
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control shadow-none" id="slug" name="slug" name="slug"
                        value="{{ old('slug', $post->slug) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Kategori</label>
                    <select class="form-select shadow-none" name="category_id">
                        <option selected>-- Choose Category --</option>
                        @foreach ($categories as $category)
                            @if (old('category_id', $post->category->id) === $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="type" class="form-label">Tipe</label>
                    <select class="form-select shadow-none" name="type_id">
                        <option selected hidden>-- Post Type --</option>
                        @foreach ($types as $type)
                            @if (old('type_id', $post->type->id) == $type->id)
                                <option value="{{ $type->id }}" selected>{{ $type->name }}</option>
                            @else
                                <option value="{{ $type->id }}">{{ $type->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="thumbnail_path"
                        class="form-label @error('thumbnail_path') is-invalid @enderror ">Cuplikan</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control shadow-none" type="file" id="thumbnail_path" name="thumbnail_path"
                        onchange="previewImage()">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Konten</label>
                    <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <div class="d-flex justify-content-end align-items-center mb-5">
                    <a href="{{ route('posts.index') }}" class="btn bg-base-color me-3 text-white shadow-none" style="height: 36px">Kembali</a>
                    <button type="submit" class="btn bg-base-color text-white border-0 px-4">Update Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
