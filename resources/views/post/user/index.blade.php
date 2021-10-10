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
{{-- <!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Template · Bootstrap v5.1</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <div class="d-flex flex-row position-absolute top-0 bottom-0 width-100">
      <div class="px-4 mt-5 text-white dashboard-sidebar text-center bg-white">
        <a class="dashboard-brand mx-auto text-decoration-none fw-bold text-dark-color" href="/"><span class="text-base-color">Start</span>Now</a>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item mt-5">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center mb-3 text-muted">
              <span>Main menu</span>
            </h6>
            <a href="#" class="nav-link active">
              <i class="bi bi-house-fill"></i> Home
            </a>
          </li>
          <li>
            <a href="#" class="nav-link">
              <i class="bi bi-grid-fill"></i> Dashboard
            </a>
          </li>
        </ul>
      </div>
      <div class="dashboard py-5 px-4 bg-light-color">
        <div class="d-flex">
          <img src="https://source.unsplash.com/random/60x60" class="rounded-circle">
          <div class="dashboard-user-welcome flex-column align-items-center justify-content-center ms-3">
            <p class="my-auto fs-5 fw-bold">Hello, Aditya Khoirul Anam</p>
            <small class="fw-bold fs-14 text-light-color">CEO of Maklo</small>
          </div>
        </div>
      </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dashboard.js"></script>
  </body>
</html>
 --}}
@extends('index')

@section('headline', 'My Posts')

@section('post')
<a href="{{ route('posts.create') }}">Create New Post</a>
<div class="row">
  @foreach ($posts as $post)
  <div class="col-lg-4">
    <a href="{{ route('posts.show', $post) }}" class="text-decoration-none text-dark">
      <div class="card overflow-hidden text-decoration-none">
        <img src="https://source.unsplash.com/random/270x128" class="card-img-top user-post-image">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <p class="card-text">{{ $post->excerpt }}</p>
          <div class="d-flex align-items-center justify-content-end">
            @can('update', $post)
              <a href="{{ route('posts.edit', $post) }}" class="icon text-warning post-edit"><i class="bi bi-pencil-square"></i></a>
            @endcan
            @can('delete', $post)
            <form action="{{ route('posts.destroy', $post) }}" method="post" class="d-inline">
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
@endsection