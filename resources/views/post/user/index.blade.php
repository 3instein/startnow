{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
@extends('index')

@section('post')
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <form action="" method="post" class="d-inline" id="delete-post-form">
                        @method('delete')
                        @csrf
                        <button class="btn btn-primary bg-base-color border-0" id="confirm-delete-btn">Delete Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @if ($posts->count())
        <div class="row mt-4">
            <div class="col-lg-10 mx-auto">
                @if (session()->has('success'))
                    <div class="alert alert-success col-lg-12 mb-3" role="alert">
                        {{ session('success') }}
                    </div>
                @endif
                <div class="row mt-3">
                    <div class="d-flex justify-content-between">
                        <h2 class="fw-bolder">Post Saya</h2>
                        <a href="{{ route('posts.create') }}" class="text-decoration-none text-base-color">
                            <i class="bi bi-plus-circle-fill me-1"></i>
                            Buat Post Baru
                        </a>
                    </div>
                    <input type="hidden" id="user-post-length" value="{{ count($posts) }}">
                    @foreach ($posts as $post)
                        <div class="col-lg-4">
                            <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                                <div class="card overflow-hidden text-decoration-none mb-3" style="height: 314px">
                                    <img src="{{ Storage::url($post->thumbnail_path) }}"
                                        class="card-img-top user-post-image" style="object-fit: cover; width: 342.66px;">
                                    <div class="card-body d-flex flex-column justify-content-between">
                                        <div>
                                            <h5 class="card-title">{{ $post->title }}</h5>
                                            <p class="card-text">{!! $post->excerpt !!}</p>
                                        </div>
                                        <div class="d-flex align-items-center justify-content-end">
                                            @can('update', $post)
                                                <a href="{{ route('posts.edit', $post) }}"
                                                    class="icon text-warning post-edit"><i class="bi bi-pencil-square"></i></a>
                                            @endcan
                                            @can('delete', $post)
                                                <button class="icon text-red-color post-delete border-0 bg-white"
                                                    id="delete-btn-{{ $loop->iteration }}" value="{{ $post->title }}"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-value="{{ route('posts.destroy', $post) }}">
                                                    <i class="bi bi-x-square-fill"></i>
                                                </button>
                                            @endcan
                                        </div>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    @else
        <div class="row mt-4">
            <h2 class="fw-bolder">My Posts</h2>
            <h4 class="text-center text-muted mt-5">No Post(s) Found</h4>
        </div>
    @endif
@endsection

@push('addon-script')
    <script>
        let deletedPost = '';
        let length = $('input[id="user-post-length"]').val();

        for (let i = 1; i <= length; i++) {
            $('#delete-btn-' + i).click(function() {
                let title = $(this).val();
                $('h5[class="modal-title"]').html('Are you sure want to delete "' + title + '" post?');
                deletedPost = $(this).data('value');
            });
        }

        $('#confirm-delete-btn').click(function() {
            $('#delete-post-form').attr('action', deletedPost);
        });
    </script>
@endpush
