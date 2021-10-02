@extends('layouts.app')

@section('body')
<div class="row pt-5 mt-5 mb-2">
  <div class="col-lg-3">
    <h6 class="fw-bold fs-4">Hot Posts</h6>
  </div>
</div>
<div class="row">
  @foreach ($hotPosts as $hotPost)
    <div class="col-lg-3">
      <a class="card text-decoration-none position-relative card-hot-post" href="">
        <img src="https://source.unsplash.com/random/160x120" class="card-img-top position-relative">
        <div class="card-hot-shadow"></div>
        <div class="card-body position-absolute bottom-0 start-50 translate-middle-x width-100">
          <h5 class="card-title text-white fs-6 pb-2 m-0">{{ $hotPost->title }}</h5>
          <div class="details d-flex align-items-center justify-content-end">
            <small class="me-auto text-white fs-11">By. {{ $hotPost->user->name }}</small>
            <small class="text-white fs-12"><i class="bi bi-eye-fill" style="color: #bab9d6"></i> {{ $hotPost->views }}</small>
            <small class="text-white fs-12 mx-2"><i class="bi bi-arrow-up-circle-fill" style="color: #0471a6"></i> {{ $hotPost->upvote }}</small>
            <small class="text-white fs-12"><i class="bi bi-arrow-down-circle-fill" style="color: #FF5C58"></i> {{ $hotPost->downvote }}</small>
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>
<div class="row mt-5">
  <div class="col-lg-8">
    <form action="" class="mb-4">
      @csrf
      <div class="input-group">  
        <input type="text" class="form-control border-end-0" placeholder="Masukan kata kunci">
        <button type="submit" name="search" class="input-group-text border-start-0 bg-white" id="search"><i class="bi bi-search"></i></button>
      </div>
    </form>
  </div>
  <div class="col-lg-2">
    <form action="" class="mb-4">
      @csrf
      <div class="dropdown">
        <select class="form-select" aria-label="Default select example">
          <option selected>Open this select menu</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
    </form>
  </div>
  <div class="col-lg-2">
    <form action="" class="mb-4">
      @csrf
      <div class="dropdown">
        <select class="form-select" aria-label="Default select example">
          <option selected>Open this select menu</option>
          <option value="1">One</option>
          <option value="2">Two</option>
          <option value="3">Three</option>
        </select>
      </div>
    </form>
  </div>
</div>
<div class="row mt-3">
  <div class="col-lg-3">
    <h6 class="fw-bold fs-4">Posts & Discussions</h6>
  </div>
</div>
<div class="row mt-3">
  <div class="col-lg-8">
    @foreach ($posts as $post)
      <div class="card shadow-medium bg-body rounded-12 border-0 p-3 mb-3">
        <div class="card-body">
          <h5 class="card-title">{{ $post->title }}</h5>
          <div class="card-post-details d-flex my-4">
            <img src="https://source.unsplash.com/random/50x50" class="card-img-top position-relative">
            <div class="card-post-details-user ms-3">
              <p class="m-0">{{ $post->user->name }}</p>
              <small>5 minutes ago</small>
            </div>
          </div>
          <p class="card-text">{{ $post->excerpt }}</p>
          <div class="details d-flex justify-content-between">
            <div class="d-flex align-items-center">
              <small class="text-dark fs-6"><i class="bi bi-eye-fill card-post-detail-view" style="color: #bab9d6"></i> {{ $post->views }}</small>
              <small class="text-dark fs-6 mx-3"><i class="bi bi-arrow-up-circle-fill card-post-detail-upvote" style="color: #0471a6"></i> {{ $post->upvote }}</small>
              <small class="text-dark fs-6"><i class="bi bi-arrow-down-circle-fill card-post-detail-downvote" style="color: #FF5C58"></i> {{ $post->downvote }}</small>
            </div>
            <a href="#" class="btn text-white btn-read-more rounded-8">Baca selengkapnya</a>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  <div class="col-lg-4">
    <div class="shadow-medium p-3 bg-body rounded-12">
      <div class="card-header bg-white fw-bold fs-5 border-0">Trending Topic</div>
      <ul class="list-group list-group-flush">
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#1 An item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#2 A second item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#3 A third item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#4 A fourth item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#5 A fifth item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#6 A sixth item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#7 A seventh item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#8 A eight item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#9 A ninth item</a></li>
        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#10 A tenth item</a></li>
      </ul>
    </div>
  </div>
</div>
@endsection