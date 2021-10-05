@extends('index')

@section('headline', 'Posts & Discussions')

@section('post')
<input type="hidden" id="post-length" value="{{ count($posts) }}" name="post-length" />
  @foreach ($posts as $post)
  <a class="card shadow-medium bg-body rounded-12 border-0 p-3 mb-3 rounded-0 text-decoration-none text-dark" href="/post/{{ $post->slug }}">
    <div class="card-body">
      <div class="d-flex align-items-center justify-content-between">
        <h5 class="card-title fw-bolder">{{ $post->title }}</h5>
        <small class="text-dark fs-14 d-flex align-items-center"><i class="bi bi-eye-fill pe-2" style="color: #bab9d6"></i>{{ $post->views }} views</small>
      </div>
      <div class="card-post-details d-flex my-4">
        <img src="https://source.unsplash.com/random/50x50" class="card-img-top position-relative">
        <div class="card-post-details-user ms-3">
          <p class="m-0 fw-bold">{{ $post->user->name }}</p>
          <small>{{ $post->created_at->diffForHumans() }}</small>
        </div>
      </div>
      <p class="card-text">{{ $post->excerpt }}</p>
      <div class="details d-flex justify-content-end">
        <div class="d-flex align-items-center">
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
    </div>
  </a>
  @endforeach
@endsection