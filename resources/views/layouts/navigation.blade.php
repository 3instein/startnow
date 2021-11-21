@if (request()->is('startups*') || (request()->is('ventures*') && auth()->user()->typeable))
@else
    <nav class="navbar bg-white navbar navbar-expand-md fixed-top">
        <div class="container">
            <div class="row align-items-center width-100">
                <div
                    class="{{ request()->is('register') || request()->is('login') || request()->is('startups') || request()->is('join') ? 'col-md-9' : 'col-md-4' }}">
                    <a class="navbar-brand text-dark-color border-0" href="{{ Route('home') }}"><span
                            class="text-base-color">Start</span>Now</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                        data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false"
                        aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div
                    class="{{ request()->is('login') || request()->is('register') || request()->is('startups') || request()->is('join') ? 'd-none' : 'col-md-5' }}">
                    <form action="/search">
                        <div class="input-group">
                            <input type="text" class="form-control border-end-0 shadow-none" name="search"
                                placeholder="Masukan kata kunci" value="{{ request('search') }}">
                            <button type="submit" class="input-group-text border-start-0 bg-white" id="search"><i
                                    class="bi bi-search"></i></button>
                        </div>
                    </form>
                </div>
                @auth
                    {{-- Profile Modal --}}
                    <div class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Profil Saya</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url(auth()->user()->profile_photo_path) == '/storage/' ? asset('icons/default-user-photo.png') : Storage::url(auth()->user()->profile_photo_path) }}"
                                            class="rounded-circle" style="width: 104px; height: 104px;">
                                        <div class="d-flex flex-column ms-4">
                                            <h4 class="fw-bold mb-0">{{ auth()->user()->name }}</h4>
                                            <p class="mb-0">{{ '@' . auth()->user()->username }}</p>
                                            <p>{{ auth()->user()->email }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a href="{{ route('users.profile') }}"
                                        class="btn bg-base-color text-decoration-none text-white">Edit Profil</a>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-3 p-0 d-flex justify-content-end">
                        <ul class="navbar-nav ms-auto">
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle text-decoration-none text-dark fw-bold" href="#"
                                    id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                    {{ auth()->user()->name }}
                                    <img src="{{ Storage::url(auth()->user()->profile_photo_path) == '/storage/' ? asset('icons/default-user-photo.png') : Storage::url(auth()->user()->profile_photo_path) }}"
                                        class="rounded-circle mx-1" style="width: 40px; height: 40px">
                                </a>
                                <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <li><a class="dropdown-item" href="{{ route('posts.index') }}"><i
                                                class="bi bi-layout-text-sidebar-reverse me-2"></i>Post Saya</a></li>
                                    <li>
                                        <button type="button" class="dropdown-item" data-bs-toggle="modal"
                                            data-bs-target="#profileModal">
                                            <i class="bi bi-person me-1"></i>
                                            Profil Saya
                                        </button>
                                        {{-- <a class="dropdown-item" href="{{ route('users.profile') }}"><i
                                                class="bi bi-person me-2"></i>Profil Saya</a> --}}
                                    </li>
                                    <li>
                                        <hr class="dropdown-divider">
                                    </li>
                                    <li>
                                        <form action="/logout" method="POST">
                                            @csrf
                                            <button type="submit" class="dropdown-item"><i
                                                    class="bi bi-box-arrow-right me-2"></i>Keluar</button>
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                @else
                    <div class="col-md-2 p-0 ms-auto">
                        <div class="navbar-nav d-flex justify-content-end">
                            <a class="nav-link btn btn-outline-primary me-3 text-base-color fw-bold shadow-none"
                                href="{{ Route('login') }}">Masuk</a>
                            <a class="nav-link btn btn-primary text-light fw-bold shadow-none bg-base-color"
                                href="{{ Route('register') }}">Daftar</a>
                        </div>
                    </div>
                @endauth
            </div>
        </div>
    </nav>
@endif
