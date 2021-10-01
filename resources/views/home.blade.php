@extends('layouts.app')

@section('body')
<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block sidebar collapse">
  <div class="position-fixed">
    <ul class="nav flex-column">
      <li class="nav-item">
        <h4 class="fw-bold">Categories</h4>
      </li>
      <div class="ms-3">
        <li class="nav-item">
          <a class="fw-normal text-decoration-none">Pendanaan</a>
        </li>
        <li class="nav-item">
          <a class="fw-normal text-decoration-none">Kolaborasi</a>
        </li>
      </div>
    </ul>
  </div>
</nav>
@endsection