@extends('layouts.app')

@section('body')
<div class="row pt-5 mt-5 mb-2">
  <div class="col-lg-3">
    <h6 class="fw-bold fs-4 d-flex">
      <img src="{{ asset('/icons/fire.png') }}" class="icon me-3">
      Hot Posts
    </h6>
  </div>
</div>
<div class="row">
  @foreach ($hotPosts as $hotPost)
    <div class="col-lg-3">
      <a class="card text-decoration-none card-hot-post text-decoration-none border-0 text-dark" href="">
        <img src="https://source.unsplash.com/random/140x80" class="card-img-top position-relative">
        <div class="card-body px-2">
          <h5 class="card-title fs-6 m-0">{{ $hotPost->title }}</h5>
          <div class="d-flex align-items-center mt-2">
            <small class="text-dark fs-12">
              <i class="bi bi-eye-fill me-1" style="color: #bab9d6"></i>
              {{ $hotPost->views }}
            </small>
            <small class="mx-2 fs-12">
              <i class="bi bi-arrow-up-circle-fill bg-white me-1" id="bi-arrow-up-circle" style="color: #0471a6"></i>
              {{ $hotPost->upvote }}
            </small>
            <small class="text-dark fs-12">
              <i class="bi bi-arrow-down-circle-fill bg-white-downvote me-1" style="color: #FF5C58"></i>
              {{ $hotPost->downvote }}
            </small>
          </div>
        </div>
      </a>
    </div>
  @endforeach
</div>
<div class="row mt-4">
  <div class="col-lg-3">
    <h6 class="fw-bold fs-4 d-flex">
      <img src="{{ asset('/icons/new-post.png') }}" class="icon me-3">
      Posts & Discussions
    </h6>
  </div>
</div>
<div class="row mt-2">
  <div class="col-lg-8">
    <input type="hidden" id="post-length" value="{{ count($posts) }}" name="post-length"></input>
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
            {{-- <a href="#" class="btn text-white btn-read-more rounded-8">Baca selengkapnya</a> --}}
          </div>
        </div>
      </a>
    @endforeach
  </div>
  <div class="col-lg-4">
    <div class="d-flex">
      <form action="" class="width-100">
        @csrf
        <div class="dropdown">
          <select class="form-select rounded-pill shadow-none" aria-label="Default select example">
            <option selected hidden>Kategori</option>
            <option value="1">Kolaborasi</option>
            <option value="2">Pendanaan</option>
          </select>
        </div>
      </form>
      <form action="" class="ms-3 width-100">
        @csrf
        <div class="dropdown">
          <select class="form-select rounded-pill shadow-none" aria-label="Default select example">
            <option selected hidden>Topik</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </form>
      <form action="" class="ms-3 width-100">
        @csrf
        <div class="dropdown">
          <select class="form-select rounded-pill shadow-none" aria-label="Default select example">
            <option selected hidden>Filter</option>
            <option value="1">One</option>
            <option value="2">Two</option>
            <option value="3">Three</option>
          </select>
        </div>
      </form>
    </div>
    <div class="shadow-medium p-3 bg-body rounded-12 mt-3 rounded-0">
      <div class="card-header bg-white fw-bold fs-5 border-0 d-flex align-items-center">
        <img src="{{ asset('/icons/hashtag.png') }}" class="icon-hashtag me-3">
        Trending Topic
      </div>
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