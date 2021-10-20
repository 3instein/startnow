@extends('layouts.app')

@section('body')
    @if (!request()->is(['profile*', 'posts*']) && $posts->count())
        <div class="row pt-5 mt-5 mb-2">
            <div class="col-lg-3">
                <h2 class="fw-bolder mb-3">
                    Popular
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 pe-3">
                <div class="card border-0">
                    <img src="{{ Storage::url($hotPosts[0]->thumbnail_path) }}" class="card-img-top rounded border" style="height: 480px; object-fit: contain">
                    <div class="card-body px-0">
                        <small class="d-flex text-muted justify-content-between">
                            <p class="mb-2 fs-12">{{ $hotPosts[0]->type->name }}</p>
                            <p class="d-flex align-items-center mb-2 fs-12">
                                <i class="bi bi-clock-history me-2"></i>
                                {{ $hotPosts[0]->created_at->diffForHumans() }}
                            </p>
                        </small>
                        <h2 class="card-title fw-bold mb-2">{{ $hotPosts[0]->title }}</h2>
                        <p class="card-text mb-4">{{ $hotPosts[0]->excerpt }}</p>
                        <a href="{{ route('posts.show', $hotPosts[0]) }}" class="btn btn-primary bg-base-color">Read
                            More</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @foreach ($hotPosts->skip(1) as $hotPost)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-0 d-flex flex-row hot-card">
                                <img src="{{ Storage::url($hotPost->thumbnail_path) }}" class="card-img-top hot-img rounded border" style="width: 144px; height: 144px; object-fit: cover">
                                <div class="card-body pt-0">
                                    <small class="d-flex text-muted justify-content-between">
                                        <p class="mb-2 fs-12">{{ $hotPost->type->name }}</p>
                                        <p class="d-flex align-items-center mb-2 fs-12">
                                            <i class="bi bi-clock-history me-2"></i>
                                            {{ $hotPost->created_at->diffForHumans() }}
                                        </p>
                                    </small>
                                    <h5 class="card-title fs-6 m-0 fw-bold mb-5 pb-2">{{ $hotPost->title }}</h5>
                                    <a href="{{ route('posts.show', $hotPost) }}"
                                        class="fw-bold text-decoration-none text-base-color border-0">Read More</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        <hr class="opacity-10" />
    @endif
    <div class="row mt-5 pb-0">
        <div class="col-lg-8">
            <h2 class="fw-bolder mb-3 @if(!$hotPosts->count()) mt-5 @endif">
                @yield('headline')
            </h2>
        </div>
    </div>
    <div class="row mt-2">
        <div class="{{ request()->is('posts/*') ? 'col-lg-12' : 'col-lg-8' }}">
            @yield('post')
        </div>
        @if (!request()->is('posts/*'))
            <div class="col-lg-4">
                <div class="d-flex sticky-top top-7">
                    <form action="" class="width-100">
                        @csrf
                        <div class="dropdown">
                            <select class="form-select shadow-none" aria-label="Default select example">
                                <option selected hidden>Type</option>
                                <option value="1">Kolaborasi</option>
                                <option value="2">Pendanaan</option>
                            </select>
                        </div>
                    </form>
                    <form action="" class="ms-3 width-100">
                        @csrf
                        <div class="dropdown">
                            <form action="">
                                <select class="form-select shadow-none" aria-label="Default select example">
                                    <option selected hidden>Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </form>
                        </div>
                    </form>
                    <form action="" class="ms-3 width-100">
                        @csrf
                        <div class="dropdown">
                            <select class="form-select shadow-none" aria-label="Default select example">
                                <option selected hidden>Filter</option>
                                <option value="1">One</option>
                                <option value="2">Two</option>
                                <option value="3">Three</option>
                            </select>
                        </div>
                    </form>
                </div>
                @auth
                    <div class="shadow-medium p-3 bg-body rounded-12 mt-3 rounded-0 sticky-top top-10">
                        <div class="card-header bg-white fw-bold fs-5 border-0">
                            <div class="col-lg-10 mx-auto text-center">
                                @if (auth()->user()->typeable)
                                    <h3 class="fw-bold m-0"><span class="text-base-color">Start</span>Now</h3>
                                    <p class="text-muted fw-normal">Start collaborating!</p>
                                    <a href="{{ route('startups.index') }}"
                                        class="btn bg-base-color text-decoration-none text-white fw-bold fs-14">My Startup</a>
                                @else
                                    <h3 class="fw-bold m-0"><span class="text-base-color">Start</span>Now</h3>
                                    <p class="text-muted fw-normal">Be a part of our community.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('startups.index', auth()->user()->typeable) }}"
                                            class="btn bg-base-color text-decoration-none text-white fw-bold fs-14 me-3">Register
                                            your business</a>
                                        <p>or</p>
                                        <a href="{{ route('join') }}"
                                            class="btn bg-base-color text-decoration-none text-white fw-bold fs-14 ms-3">Join
                                            existing business</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth
                <div class="shadow-medium p-3 bg-body rounded-12 mt-3 rounded-0 sticky-top @auth top-14 @endauth @guest top-10 @endguest">
                    <div class="card-header bg-white fw-bold fs-5 border-0 d-flex align-items-center">
                        <img src="{{ asset('/icons/hashtag.png') }}" class="icon-hashtag me-3">
                        Trending Topic
                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#1 An
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#2 A
                                second
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#3 A
                                third
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#4 A
                                fourth
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#5 A
                                fifth
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#6 A
                                sixth
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#7 A
                                seventh item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#8 A
                                eight
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#9 A
                                ninth
                                item</a></li>
                        <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#10 A
                                tenth
                                item</a></li>
                    </ul>
                </div>
            </div>
        @endif
    </div>
@endsection
