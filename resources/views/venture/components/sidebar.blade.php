<nav id="sidebarMenu" class="col-md-1 d-md-block bg-light sidebar collapse mt-3">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link fs-5 {{ request()->is('ventures') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('ventures.index') }}">
                    <i class="bi bi-house-door-fill"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5 {{ request()->is('ventures/*/members') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('ventures.members', auth()->user()->typeable) }}">
                    <i class="bi bi-person-lines-fill"></i>
                    Members
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5 {{ request()->is('startups/*/requests') ? 'active' : '' }}"
                    aria-current="page" href="{{ route('startups.requests', auth()->user()->typeable) }}">
                    <i class="bi bi-envelope-fill"></i>
                    Requests
                </a>
            </li>
        </ul>
    </div>
</nav>
