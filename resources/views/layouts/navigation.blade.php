<nav class="navbar navbar-expand-lg mb-5">
    <div class="container">
      <div class="row align-items-center width-100">
        <div class="col-md-2">
          <a class="navbar-brand text-dark-color" href="/"><span class="text-base-color">Start</span>Now</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
        </div>
        <div class="col-md-5 mx-auto">
          <form action="">
            @csrf
            <div class="input-group">  
              <input type="text" class="form-control border-end-0" placeholder="Masukan kata kunci">
              <button type="submit" name="search" class="input-group-text border-start-0 bg-white" id="search"><i class="bi bi-search"></i></button>
            </div>
          </form>
        </div>
        <div class="col-md-2">
          <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
              <a class="nav-link btn btn-outline-primary me-3 text-base-color fw-bold" href="{{ Route('login') }}">Masuk</a>
              <a class="nav-link btn btn-primary text-light fw-bold bg-base-color" href="{{ Route('register') }}">Daftar</a>
            </div>
          </div>
        </div>
      </div>
    </div>
  </nav>