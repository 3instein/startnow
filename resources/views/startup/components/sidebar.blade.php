<nav id="sidebarMenu" class="col-md-1 d-md-block bg-light sidebar collapse mt-3">
  <div class="position-sticky pt-3">
    <ul class="nav flex-column">
      <li class="nav-item">
        <a class="nav-link fs-5 {{ request()->is('startups') ? 'active' : '' }}" aria-current="page" href="{{ route('startups.index') }}">
          <i class="bi bi-house-door-fill"></i>
          Dashboard
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link fs-5 {{ request()->is('startups/members') ? 'active' : '' }}" aria-current="page" href="{{ route('startups.members', auth()->user()->typeable) }}">
          <i class="bi bi-person-lines-fill"></i>
          Members
        </a>
      </li>
    </ul>
  </div>
</nav>