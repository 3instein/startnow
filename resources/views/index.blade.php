@extends('layouts.app')

@section('body')
    @if (!request()->is(['profile*', 'posts*']) && $posts->count())
        <div class="row pt-5 mt-5 mb-2">
            <div class="col-lg-3">
                <h2 class="fw-bolder mb-3">
                    Post Terpopuler
                </h2>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 pe-3">
                <div class="card border-0">
                    <img src="{{ Storage::url($hotPosts[0]->thumbnail_path) }}" class="card-img-top rounded border"
                        style="height: 480px; object-fit: contain">
                    <div class="card-body px-0">
                        <small class="d-flex text-muted justify-content-between">
                            <p class="mb-2 fs-12">{{ $hotPosts[0]->type->name }}</p>
                            <p class="d-flex align-items-center mb-2 fs-12">
                                <i class="bi bi-clock-history me-2"></i>
                                {{ str_replace(['hours', 'hour', 'ago'], ['jam', 'jam', 'lalu'], $hotPosts[0]->created_at->diffForHumans()) }}
                            </p>
                        </small>
                        <h2 class="card-title fw-bold mb-2">{{ $hotPosts[0]->title }}</h2>
                        <p class="card-text mb-4">{{ $hotPosts[0]->excerpt }}</p>
                        <a href="{{ route('posts.show', $hotPosts[0]) }}" class="btn btn-primary bg-base-color">Baca
                            Selengkapnya</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-4">
                @foreach ($hotPosts->skip(1) as $hotPost)
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="card border-0 d-flex flex-row hot-card">
                                <img src="{{ Storage::url($hotPost->thumbnail_path) }}"
                                    class="card-img-top hot-img rounded border"
                                    style="width: 144px; height: 144px; object-fit: cover">
                                <div class="card-body pt-0 d-flex flex-column justify-content-between">
                                    <div>
                                        <small class="d-flex text-muted justify-content-between">
                                            <p class="mb-2 fs-12">{{ $hotPost->type->name }}</p>
                                            <p class="d-flex align-items-center mb-1 fs-12">
                                                <i class="bi bi-clock-history me-2"></i>
                                                {{ str_replace(['hours', 'hour', 'ago'], ['jam', 'jam', 'lalu'], $hotPost->created_at->diffForHumans()) }}
                                            </p>
                                        </small>
                                        <h5 class="card-title fs-6 m-0 fw-bold">{{ $hotPost->title }}</h5>
                                    </div>
                                    <a href="{{ route('posts.show', $hotPost) }}"
                                        class="fw-bold text-decoration-none text-base-color border-0 mb-2">Baca
                                        Selengkapnya</a>
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
            <h2 class="fw-bolder mb-3 @if (!$hotPosts->count()) mt-5 @endif">
                @yield('headline')
            </h2>
        </div>
    </div>
    <div class="row mt-2 mb-5 pb-5">
        <div class="{{ request()->is('posts*') ? 'col-lg-12' : 'col-lg-8' }}" id="all-post">
            @yield('post')
        </div>
        @if (!request()->is('posts*'))
            <div class="col-lg-4 pt-5">
                <div class="sticky-top top-7">
                    <form class="d-flex flex-column" id="filter-form" method="GET">
                        <div class="d-flex mb-3">
                            <div class="dropdown width-100 me-3">
                                <select class="form-select shadow-none" aria-label="Default select example" name="type"
                                    id="filter">
                                    <option selected hidden disabled>Type</option>
                                    @foreach ($types as $type)
                                        <option value="{{ $type->id }}"
                                            {{ request()->query('type', null) == $type->id ? 'selected' : '' }}>
                                            {{ $type->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="dropdown width-100">
                                <select class="form-select shadow-none" aria-label="Default select example" name="category"
                                    id="filter">
                                    <option selected hidden disabled>Category</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}"
                                            {{ request()->query('category', null) == $category->id ? 'selected' : '' }}>
                                            {{ $category->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <a href="{{ route('home') }}" class="btn border-0 text-white shadow-none" style="background-color: #bab9d6;" id="btn-reset">Hapus Filter</a>
                    </form>
                </div>
                @auth
                    <div class="shadow-medium p-3 bg-body rounded-12 mt-3 rounded-0 sticky-top top-10">
                        <div class="card-header bg-white fw-bold fs-5 border-0">
                            <div class="col-lg-12 mx-auto text-center">
                                @if (auth()->user()->typeable_type == 'App\Models\Startup')
                                    <h3 class="fw-bold m-0"><span class="text-base-color">Start</span>Now</h3>
                                    <p class="text-muted fw-normal">Start collaborating!</p>
                                    <a href="{{ route('startups.index') }}"
                                        class="btn bg-base-color text-decoration-none text-white fw-bold fs-14">My Startup</a>
                                @elseif (auth()->user()->typeable_type == 'App\Models\Venture')
                                    <h3 class="fw-bold m-0"><span class="text-base-color">Start</span>Now</h3>
                                    <p class="text-muted fw-normal">Start collaborating!</p>
                                    <a href="{{ route('ventures.index') }}"
                                        class="btn bg-base-color text-decoration-none text-white fw-bold fs-14">My Venture</a>
                                @else
                                    <h3 class="fw-bold m-0"><span class="text-base-color">Start</span>Now</h3>
                                    <p class="text-muted fw-normal">Jadilah bagian dari komunitas kami.</p>
                                    <div class="d-flex justify-content-between align-items-center">
                                        <a href="{{ route('startups.index', auth()->user()->typeable) }}"
                                            class="btn bg-base-color text-decoration-none text-white fw-bold fs-14 me-3">Daftarkan
                                            Bisnis Anda</a>
                                        <p>atau</p>
                                        <a href="{{ route('join') }}"
                                            class="btn bg-base-color text-decoration-none text-white fw-bold fs-14 ms-3">Bergabung
                                            dengan Bisnis</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @endauth
            </div>
            <div class="d-flex justify-content-center mt-4">
                {{ $posts->links() }}
            </div>
        @endif
    </div>
@endsection

@push('addon-script')
    <script>
        let form = document.getElementById('filter-form');
        let selects = form.querySelectorAll('select');

        for (const select of selects) {
            select.addEventListener('change', function() {
                form.submit();
            });
        }

        form.querySelector('button').addEventListener('click', function() {
            for (const select of selects) {
                select.value = undefined;
            }
            form.submit();
        });
    </script>
@endpush
