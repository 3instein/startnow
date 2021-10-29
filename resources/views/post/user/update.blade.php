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
    </script>
@endpush

@section('post')
    <div class="row mt-4">
        <div class="col-lg-10 mx-auto">
            <h2 class="fw-bolder">Edit Post</h2>
            <form action="{{ route('posts.update', $post) }}" class="mt-3" method="POST"
                enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label @error('title') is-invalid @enderror ">Title</label>
                    <input type="text" class="form-control shadow-none" id="title" name="title"
                        value="{{ old('title', $post->title) }}" required autofocus>
                </div>
                <div class="mb-3">
                    <input type="hidden" class="form-control shadow-none" id="slug" name="slug" name="slug"
                        value="{{ old('slug', $post->slug) }}" readonly>
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Category</label>
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
                    <label for="thumbnail_path"
                        class="form-label @error('thumbnail_path') is-invalid @enderror ">Thumbnail</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control shadow-none" type="file" id="thumbnail_path" name="thumbnail_path"
                        onchange="previewImage()">
                </div>
                <div class="mb-3">
                    <label for="body" class="form-label">Body</label>
                    <input id="body" type="hidden" name="body" value="{{ old('body', $post->body) }}">
                    <trix-editor input="body"></trix-editor>
                </div>
                <div class="width-100 text-end">
                  <button type="submit" class="btn bg-base-color text-white border-0 mb-5 px-4">Update Post</button>
                </div>
            </form>
        </div>
    </div>
@endsection
