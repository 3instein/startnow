@extends('layouts.app')

@section('body')
<div class="row mt-5 pt-5">
  <div class="col-md-2">
    <nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
      <div class="position-fixed">
        <ul class="nav flex-column">
          <li class="nav-item mb-2">
            <h4 class="fw-bold fs-3">Categories</h4>
          </li>
          <div class="ms-2">
            @foreach ($categories as $category)
              <li class="nav-item mb-1">
                <a class="fw-normal text-decoration-none text-dark" href="">{{ $category->name }}</a>
              </li>
            @endforeach
          </div>
        </ul>
      </div>
    </nav>
  </div>
  <div class="col-md-7 mx-auto">
    <form action="" class="mb-4">
      @csrf
      <div class="input-group">  
        <input type="text" class="form-control border-end-0" placeholder="Masukan kata kunci">
        <button type="submit" name="search" class="input-group-text border-start-0 bg-white" id="search"><i class="bi bi-search"></i></button>
      </div>
    </form>
    @foreach ($posts as $post)
      <div class="card width-100 mb-3 shadow-sm p-2 pb-1 bg-body rounded overflow-hidden">
        <div class="card-body">
          <h5 class="card-title mb-3 fw-bold">{{ $post->title }}</h5>
          <div class="post-detail d-flex mb-3">
            <img src="https://source.unsplash.com/random/50x50" class="rounded-circle border border-dark" style="object-fit: contain">
            <div class="user-detail flex-column ms-3">
              <p class="mb-0 fw-bold">{{ $post->user->name }}</p>
              <a class="mb-0 text-decoration-none text-base-color" href="">{{ $post->category->name }}</a>
            </div>
          </div>
          <p class="card-text">{{ $post->excerpt }}</p>
          <hr style="width: 200%; margin-left: -10rem">
          <div class="details d-flex justify-content-between">
            <div class="d-flex align-items-center">
              <small class="text-dark fs-6"><i class="bi bi-eye-fill" style="color: #bab9d6"></i> {{ $post->views }}</small>
              <small class="text-dark fs-6 mx-3"><i class="bi bi-arrow-up-circle-fill" style="color: #0471a6"></i> {{ $post->upvote }}</small>
              <small class="text-dark fs-6"><i class="bi bi-arrow-down-circle-fill" style="color: #FF5C58"></i> {{ $post->downvote }}</small>
            </div>
            <a href="#" class="btn text-white btn-read-more">Read more</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="col-md-3">
    <div class="card-header bg-white border-bottom-0 pt-0">
      <h5 class="fw-bold text-center fs-3">Hot Posts</h5>
    </div>
    <ul class="list-group list-group-flush">
      <li class="list-group-item">
        @foreach ($hotPosts as $hotPost)
          <a class="card border-1 mb-2 text-decoration-none" href="">
            <img src="https://source.unsplash.com/random/180x120" style="object-fit: cover" class="card-img-top">
            <div class="card-body">
              <h5 class="card-title text-dark fs-5">{{ $hotPost->title }}</h5>
              <p class="card-text fs-14 text-dark">{{ $hotPost->excerpt }}</p>
              <div class="details d-flex align-items-center">
                <small class="text-dark fs-12"><i class="bi bi-eye-fill" style="color: #bab9d6"></i> {{ $hotPost->views }}</small>
                <small class="text-dark fs-12 mx-auto"><i class="bi bi-arrow-up-circle-fill" style="color: #0471a6"></i> {{ $hotPost->upvote }}</small>
                <small class="text-dark fs-12"><i class="bi bi-arrow-down-circle-fill" style="color: #FF5C58"></i> {{ $hotPost->downvote }}</small>
              </div>
            </div>
          </a>
        @endforeach
      </li>
    </ul>
  </div>
</div>
@endsection