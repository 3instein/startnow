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
    <div class="mt-4 pt-3">
        <a href="{{ route('posts.create') }}" class="border-bottom text-decoration-none form-control text-center">
            <i class="bi bi-plus-circle-fill text-base-color me-1"></i>
            Create New Post
        </a>
    </div>
    @if ($posts->count())
        <div class="row mt-4">
            <h2 class="fw-bolder">My Posts</h2>
            @foreach ($posts as $post)
                <div class="col-lg-4">
                    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
                        <div class="card overflow-hidden text-decoration-none mb-3">
                            <img src="{{ Storage::url($post->thumbnail_path) }}" class="card-img-top user-post-image"
                                style="object-fit: cover; width: 270px;">
                            <div class="card-body">
                                <h5 class="card-title">{{ $post->title }}</h5>
                                <p class="card-text">{!! $post->excerpt !!}</p>
                                <div class="d-flex align-items-center justify-content-end">
                                    @can('update', $post)
                                        <a href="{{ route('posts.edit', $post) }}" class="icon text-warning post-edit"><i
                                                class="bi bi-pencil-square"></i></a>
                                    @endcan
                                    @can('delete', $post)
                                        <form action="{{ route('posts.destroy', $post) }}" method="post"
                                            class="d-inline">
                                            @method('delete')
                                            @csrf
                                            <button class="icon text-red-color post-delete border-0 bg-white">
                                                <i class="bi bi-x-square-fill"></i>
                                            </button>
                                        </form>
                                    @endcan
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    @else
        <div class="row mt-4">
            <h2 class="fw-bolder">My Posts</h2>
            <h4 class="text-center text-muted mt-5">No Post(s) Found</h4>
        </div>
    @endif
@endsection
