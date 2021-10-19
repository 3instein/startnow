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
    <div class="row" style="min-height: 87vh">
        <div class="col m-auto">
            <h2 class="fw-bolder mb-3 mt-4">Create a New Post</h2>
            <form action="/posts" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label @error('title') is-invalid @enderror">Title</label>
                    <input type="text" class="form-control shadow-none" id="title" name="title" value="{{ old('title') }}"
                        autofocus>
                    @error('title')
                        <div class="text-start invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control shadow-none" id="slug" name="slug" name="slug"
                        value="{{ old('slug') }}">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
                    <select class="form-select shadow-none" name="category_id">
                        <option selected hidden>-- Choose Category --</option>
                        @foreach ($categories as $category)
                            @if (old('category_id') == $category->id)
                                <option value="{{ $category->id }}" selected>{{ $category->name }}</option>
                            @else
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="mb-3">
                    <label for="thumbnail_path"
                        class="form-label @error('thumbnail_path') is-invalid @enderror">Thumbnail</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control shadow-none" type="file" id="thumbnail_path" name="thumbnail_path"
                        onchange="previewImage()">
                    @error('thumbnail_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <input id="body" type="hidden" name="body" value="{{ old('body') }}">
                    <trix-editor input="body"></trix-editor>
                    @error('body')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <button type="submit" class="btn bg-base-color text-white border-0 mb-5">Create Post</button>
            </form>
        </div>
    </div>
@endsection
