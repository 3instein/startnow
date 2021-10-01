<nav class="navbar bg-white navbar navbar-expand-md fixed-top">
    <div class="container">
      <div class="row align-items-center width-100">
        <div class="col-md-10">
          <a class="navbar-brand text-dark-color" href="/"><span class="text-base-color">Start</span>Now</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-2 ms-auto p-0">
          <div class="navbar-nav d-flex justify-content-end">
            <a class="nav-link btn btn-outline-primary me-3 text-base-color fw-bold" href="{{ Route('login') }}">Masuk</a>
            <a class="nav-link btn btn-primary text-light fw-bold bg-base-color" href="{{ Route('register') }}">Daftar</a>
          </div>
        </div>
      </div>
    </div>
  </nav>