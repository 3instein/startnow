{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    You're logged in!
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Dashboard Template · Bootstrap v5.1</title>

    <!-- Bootstrap core CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css">

    <!-- Custom styles for this template -->
    <link href="/css/dashboard.css" rel="stylesheet" />
    <link rel="stylesheet" href="/css/app.css">
  </head>
  <body>
    <div class="d-flex flex-row position-absolute top-0 bottom-0 width-100">
      <div class="px-4 mt-5 text-white dashboard-sidebar text-center bg-white">
        <a class="dashboard-brand mx-auto text-decoration-none fw-bold text-dark-color" href="/"><span class="text-base-color">Start</span>Now</a>
        <ul class="nav nav-pills flex-column mb-auto">
          <li class="nav-item mt-5">
            <h6 class="sidebar-heading d-flex justify-content-between align-items-center mb-3 text-muted">
              <span>Main menu</span>
            </h6>
            <a href="#" class="nav-link active">
              <i class="bi bi-house-fill"></i> Home
            </a>
          </li>
          <li>
            <a href="#" class="nav-link">
              <i class="bi bi-grid-fill"></i> Dashboard
            </a>
          </li>
        </ul>
      </div>
      <div class="dashboard py-5 px-4 bg-light-color">
        <div class="d-flex">
          <img src="https://source.unsplash.com/random/60x60" class="rounded-circle">
          <div class="dashboard-user-welcome flex-column align-items-center justify-content-center ms-3">
            <p class="my-auto fs-5 fw-bold">Hello, Aditya Khoirul Anam</p>
            <small class="fw-bold fs-14 text-light-color">CEO of Maklo</small>
          </div>
        </div>
      </div>
    </div>
    {{-- <form action="/logout" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form> --}}

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/js/dashboard.js"></script>
  </body>
</html>

