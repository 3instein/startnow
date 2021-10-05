@extends('index')

@section('headline')
{{ $post->title }}
@endsection

@section('post')
<div class="card shadow-medium bg-body border-0 px-4 py-3 mb-3">
  <div class="card-post-details d-flex my-4 justify-content-between">
    <div class="d-flex">
      <img src="https://source.unsplash.com/random/50x50" class="user-icon rounded-circle">
      <div class="card-post-details-user ms-3">
        <p class="m-0 fw-bold">{{ $post->user->name }}</p>
        <small class="text-muted opacity-50">Posted {{ $post->created_at->diffForHumans() }}</small>
      </div>
    </div>
    <div class="dropdown">
      <button class="btn btn-secondary border-0 bg-white text-dark shadow-none" type="button" id="report" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots icon"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="report">
        <li><a class="dropdown-item" href="#">Laporkan</a></li>
      </ul>
    </div>
  </div>
  <img src="https://source.unsplash.com/random/760x400" class="card-img-top">
  <div class="my-4">
    {{ $post->body }}
  </div>
  <div class="btn-group" role="group" aria-label="Basic outlined example">
    <button type="button" class="btn text-dark fw-bold" style="border: 1px solid #C6CACD">
      <i class="bi bi-arrow-up-circle-fill me-2 text-base-color"></i>
      Upvote
    </button>
    <button type="button" class="btn text-dark fw-bold" style="border: 1px solid #C6CACD">
      <i class="bi bi-chat-right-text-fill me-2"></i>
      Comment
    </button>
    <button type="button" class="btn text-dark fw-bold" style="border: 1px solid #C6CACD">
      <i class="bi bi-arrow-down-circle-fill me-2 text-danger"></i>
      Downvote
    </button>
  </div>
</div>
<div class="card shadow-medium bg-body border-0 px-4 mb-3 position-relative" id="card-comment">
  <div class="card-post-details d-flex my-4 justify-content-between">
    <div class="d-flex">
      <img src="https://source.unsplash.com/random/50x50" class="user-icon rounded-circle">
      <div class="card-post-details-user ms-3">
        <p class="m-0 fw-bold">{{ $post->user->name }}</p>
        <small class="text-muted opacity-50">Posted {{ $post->created_at->diffForHumans() }}</small>
      </div>
    </div>
    <div class="dropdown">
      <button class="btn btn-secondary border-0 bg-white text-dark shadow-none" type="button" id="report" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots icon"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="report">
        <li><a class="dropdown-item" href="#">Laporkan</a></li>
      </ul>
    </div>
  </div>
  <div class="pb-1">
    {{ $post->body }}
  </div>
  <div class="d-flex align-items-center justify-content-end pb-3">
    <small class="me-3">
      <form action="">
        @csrf
        <button class="border-0 bg-white d-flex align-items-center" style="color: #0471a6" id="add-upvote-{{ $post->id }}">
          <i class="bi bi-arrow-up-circle-fill card-post-detail-upvote fs-24 me-2"></i>
          <span class="text-dark text-upvote-{{ $post->id }} fs-6">{{ $post->upvote }}</span>
        </button>
      </form>
    </small>
    <small class="text-dark fs-5">
      <form action="">
        @csrf
        <button class="border-0 bg-white d-flex align-items-center" style="color: #FF5C58" id="add-downvote-{{ $post->id }}">
          <i class="bi bi-arrow-down-circle-fill card-post-detail-downvote fs-24 me-2"></i>
          <span class="text-dark text-downvote-{{ $post->id }} fs-6">{{ $post->downvote }}</span>
        </button> 
      </form>
    </small>
  </div>
</div>
@endsection