@extends('layouts.app')

@push('addon-style')
    <style>
        .selected {
            background-color: #0471a6;
            border: 1px solid #0471a6;
            color: #fff !important;
        }

        .selected:hover {
            background-color: #0471a6;
            border: 1px solid #0471a6;
            color: #fff;
        }

        .btn-outline-base {
            border: 1px solid #0471a6;
            color: #0471a6;
        }

    </style>
@endpush

@section('body')
    @if ($results ?? null)
        <div class="row mt-5 pt-5">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('search') }}" method="post" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text"
                            class="form-control border-end-0 shadow-none fs-5 py-2 px-3 rounded-pill-start ps-4"
                            name="search-business" placeholder="Cari perusahaan" value="{{ request('search-business') }}">
                        <button type="submit" class="input-group-text border-start-0 bg-white fs-5 rounded-pill-end pe-4"
                            id="search-business"><i class="bi bi-search"></i></button>
                    </div>
                    <div class="btn-group mx-auto width-100 mt-3" role="group" aria-label="Basic radio toggle button group">
                        <input type="hidden" name="type" value="{{ request('search-radio') }}">
                        <input type="radio" class="btn-check" name="search-radio" id="startup-radio" autocomplete="off"
                            value="startup">
                        <label class="btn btn-outline-base rounded-start shadow-none ms-3"
                            for="startup-radio">Startups</label>
                        <input type="radio" class="btn-check" name="search-radio" id="venture-radio" autocomplete="off"
                            value="venture">
                        <label class="btn btn-outline-base rounded-end shadow-none me-3"
                            for="venture-radio">Perusahaan</label>
                    </div>
                </form>
                @foreach ($results as $result)

                    {{-- Join company modal --}}
                    <div class="modal fade" id="join-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Join Request</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form
                                        action="{{ $type == 'startup' ? route('startups.join', $result) : route('ventures.join', $result) }}">
                                        @csrf
                                        <div class="row mb-3">
                                            <div class="form-floating">
                                                <input type="name" name="name" class="form-control shadow-none" id="name"
                                                    placeholder="name@example.com" autocomplete="off"
                                                    value="{{ auth()->user()->name }}" required>
                                                <label for="name" class="ms-2">Name</label>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="form-floating">
                                                <input type="position" name="position" class="form-control shadow-none"
                                                    id="position" placeholder="name@example.com" autocomplete="off"
                                                    required>
                                                <label for="position" class="ms-2">Position</label>
                                            </div>
                                        </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary bg-base-color">Submit</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Overview company modal --}}
                    <div class="modal fade" id="overview-modal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable"
                            style="max-width: 700px !important;">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">{{ $result->name }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ Storage::url($result->logo_path) }}"
                                            class="card-img-top post-thumbnail rounded"
                                            style="width: 104px; height: 104px;">
                                        <div class="d-flex flex-column ms-3 width-100">
                                            <h4 class="fw-bold mb-0">{{ $result->name }}</h4>
                                            <div class="d-flex justify-content-between mt-2 p-2 px-3 rounded"
                                                style="background-color: rgba(186, 185, 214, .2)">
                                                <div class="d-flex flex-column">
                                                    <h6>Jumlah Karyawan</h6>
                                                    <small>{{ $result->users->count() }} orang</small>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6>Alamat</h6>
                                                    <small>{{ $result->address }}</small>
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <h6>Kontak</h6>
                                                    <small>{{ $result->contact }}</small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="px-2 mt-4">
                                        <h5 class="fw-bold">Tentang Kami</h5>
                                        <p>{!! $result->about !!}</p>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kembali</button>
                                    <button type="button" class="text-light text-decoration-none btn bg-base-color"
                                        data-bs-toggle="modal" data-bs-target="#join-modal">Gabung</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Search company result --}}
                    <div class="border-0 d-flex flex-row">
                        <img src="{{ Storage::url($result->logo_path) }}" class="card-img-top post-thumbnail rounded"
                            style="width: 96px; height: 96px;">
                        <div class="card-body py-0">
                            <div class="d-flex justify-content-between">
                                <small class="d-flex flex-column">
                                    <button type="button" class="bg-transparent border-0 fs-3 fw-bold mb-0"
                                        data-bs-toggle="modal" data-bs-target="#overview-modal">
                                        {{ $result->name }}
                                    </button>
                                    Bergabung
                                    {{ str_replace(['hours', 'hour', 'ago'], ['jam', 'jam', 'lalu'], $result->created_at->diffForHumans()) }}
                                </small>

                            </div>
                        </div>
                    </div>
                    <hr class="opacity-10 my-4" />
                @endforeach
            </div>
        </div>
    @else
        <div class="col-lg-4 position-absolute top-50 start-50 translate-middle">
            <h1 class="text-center mb-5" style="font-size: 5rem">StartNow</h1>
            <form action="{{ route('search') }}" method="post">
                @csrf
                <div class="input-group">
                    <input type="text" class="form-control border-end-0 shadow-none fs-5 py-2 ps-4 rounded-pill-start"
                        name="search-business" placeholder="Cari perusahaan">
                    <button type="submit" class="input-group-text border-start-0 bg-white fs-5 rounded-pill-end pe-4"
                        id="search-business"><i class="bi bi-search"></i></button>
                </div>
                <div class="btn-group mx-auto width-100 mt-3" role="group" aria-label="Basic radio toggle button group">
                    <input type="hidden" name="type" value="">
                    <input type="radio" class="btn-check" name="search-radio" id="startup-radio" autocomplete="off"
                        value="startup">
                    <label class="btn btn-outline-base rounded-start shadow-none ms-3" for="startup-radio">Startups</label>
                    <input type="radio" class="btn-check" name="search-radio" id="venture-radio" autocomplete="off"
                        value="venture">
                    <label class="btn btn-outline-base rounded-end shadow-none me-3" for="venture-radio">Perusahaan</label>
                </div>
            </form>
        </div>
    @endif
@endsection

@push('addon-script')
    <script>
        $(function() {
            const selectedRadio = $('input[name="search-radio"]');
            for (const radio of selectedRadio) {
                radio.addEventListener('click', function() {
                    if (radio.value === 'startup') {
                        document.querySelector('label[for="startup-radio"]').classList.add('selected');
                        document.querySelector('label[for="venture-radio"]').classList.remove('selected');
                        document.querySelector('input[name="type"]').value = radio.value;
                    } else {
                        document.querySelector('label[for="startup-radio"]').classList.remove('selected');
                        document.querySelector('label[for="venture-radio"]').classList.add('selected');
                        document.querySelector('input[name="type"]').value = radio.value;
                    }
                });
            }

            const stateChecked = document.querySelector('input[name="type"]');
            if (stateChecked.value !== '') {
                if (stateChecked.value === 'startup') {
                    document.querySelector('label[for="startup-radio"]').classList.add('selected');
                    document.querySelector('label[for="venture-radio"]').classList.remove('selected');
                    document.querySelector('input[name="type"]').value = radio.value;
                } else {
                    document.querySelector('label[for="startup-radio"]').classList.remove('selected');
                    document.querySelector('label[for="venture-radio"]').classList.add('selected');
                    document.querySelector('input[name="type"]').value = radio.value;
                }
            }
        });
    </script>
@endpush
