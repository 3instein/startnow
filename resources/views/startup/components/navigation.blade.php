@push('addon-style')
    <style>
        a:hover {
            color: #fff !important;
            background-color: #0471a6;
        }

    </style>
@endpush

<header class="navbar navbar-dark sticky-top bg-base-color flex-md-nowrap p-0 shadow">
    <a class="navbar-brand col-md-1 me-0 px-3 bg-base-color" href="{{ route('home') }}"
        style="background-color: #0471a6 !important">StartNow</a>
    <div class="navbar-nav">
        <div class="d-flex align-items-center">
            @if (auth()->user()->typeable->owner_id == auth()->user()->id)
                <a href="{{ route('startups.edit', auth()->user()->typeable) }}"
                    class="text-decoration-none text-white me-3  ">
                    <i class="bi bi-gear-fill me-1"></i>
                    Edit Profil
                </a>
            @endif
            <form action="/logout" method="post">
                @csrf
                <button class="border-0 bg-base-color text-white p-4 d-flex align-items-center"><i
                        class="bi bi-box-arrow-right me-2"></i>Logout</button>
            </form>
        </div>
    </div>
</header>
