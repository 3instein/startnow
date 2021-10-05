<nav class="navbar bg-white navbar navbar-expand-md fixed-top">
    <div class="container">
      <div class="row align-items-center width-100">
        <div class="{{ request()->is('login') ? 'col-md-10' : 'col-md-4' }}">
          <a class="navbar-brand text-dark-color" href="{{ Route('home') }}"><span class="text-base-color">Start</span>Now</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="{{ request()->is('login') ? 'd-none' : 'col-md-5' }}">
          <form action="">
            @csrf
            <div class="input-group">
              <input type="text" class="form-control border-end-0 rounded-pill-start shadow-none" placeholder="Masukan kata kunci">
              <button type="submit" name="search" class="input-group-text border-start-0 bg-white rounded-pill-end" id="search"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>
        @auth
        <div class="col-md-3 p-0 d-flex justify-content-end">
          <ul class="navbar-nav ms-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle text-decoration-none text-dark fw-bold" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                {{ auth()->user()->name }}
                <img src="https://source.unsplash.com/random/40x40" class="rounded-circle mx-1">
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="{{ Route('dashboard') }}"><i class="bi bi-layout-text-sidebar-reverse me-1"></i>My Dashboard</a></li>
                <li><hr class="dropdown-divider"></li>
                <li>
                  <form action="/logout" method="POST">
                    @csrf
                    <button type="submit" class="dropdown-item"><i class="bi bi-box-arrow-right me-1"></i>Logout</button>
                  </form>
                </li>
              </ul>
            </li>
          </ul>
        </div>
        @else
          <div class="col-md-3 p-0">
            <div class="navbar-nav d-flex justify-content-end">
              <a class="nav-link btn btn-outline-primary me-3 text-base-color fw-bold" href="{{ Route('login') }}">Masuk</a>
              <a class="nav-link btn btn-primary text-light fw-bold bg-base-color" href="{{ Route('register') }}">Daftar</a>
            </div>
          </div>
        @endauth
      </div>
    </div>
  </nav>