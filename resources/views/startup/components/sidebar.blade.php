@push('addon-style')
    <style>
        .active {
            color: #fff !important;
            background-color: #0471a6;
            border-right: 1px solid #DFE0E1 !important;
        }

        .nav-link:hover {
            color: #0471a6 !important;
            background-color: #F8F9FA !important;
            border-right: 1px solid #DFE0E1 !important;
        }
    </style>
@endpush

<nav id="sidebarMenu" class="col-md-1 d-md-block bg-light sidebar collapse mt-3">
    <div class="position-sticky pt-3">
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link fs-5 {{ request()->is('startups') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('startups.index') }}">
                    <i class="bi bi-house-door-fill"></i>
                    Dashboard
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link fs-5 {{ request()->is('startups/*/members') ? 'active' : '' }}" aria-current="page"
                    href="{{ route('startups.members', auth()->user()->typeable) }}">
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
