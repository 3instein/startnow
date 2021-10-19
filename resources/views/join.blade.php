@extends('layouts.app')

@section('body')
    @if ($results ?? null)
        <div class="row mt-5 pt-5">
            <div class="col-lg-8 mx-auto">
                <form action="{{ route('search') }}" method="post" class="mb-4">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-end-0 shadow-none fs-5 py-2 px-3"
                            name="search-business" placeholder="Cari perusahaan">
                        <button type="submit" class="input-group-text border-start-0 bg-white fs-5" id="search-business"><i
                                class="bi bi-search"></i></button>
                    </div>
                    <div class="btn-group mx-auto width-100 mt-3" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="search-radio" id="startup-radio" autocomplete="off"
                            value="startup">
                        <label class="btn btn-outline-primary" for="startup-radio">Startups</label>
                        <input type="radio" class="btn-check" name="search-radio" id="venture-radio" autocomplete="off"
                            value="venture">
                        <label class="btn btn-outline-primary" for="venture-radio">Perusahaan</label>
                    </div>
                </form>
                @foreach ($results as $result)
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
                                        action="{{ $type == 'startup' ? route('startups.join', $result) : route('ventures.join') }}">
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
                    <div class="card border-0 d-flex flex-row hot-card">
                        <img src="https://source.unsplash.com/random/168x168" class="card-img-top post-thumbnail rounded">
                        <div class="card-body py-0">
                            <div class="d-flex justify-content-between">
                                <small>
                                    <p class="fs-3 fw-bold mb-0">{{ $result->name }} <small class="fs-6 fw-normal">in
                                            <small
                                                class="text-base-color">{{ strtoupper($result->category->name) }}</small></small>
                                    </p>
                                    <p class="fs-6 mb-5 pb-4">
                                        Registered {{ $result->created_at->diffForHumans() }}
                                    </p>
                                    <p class="fs-12 text-muted pt-2">
                                        Contact {{ $result->contact }}
                                    </p>
                                </small>
                                <button type="button"
                                    class="mb-3 text-light text-decoration-none btn bg-base-color align-self-end"
                                    data-bs-toggle="modal" data-bs-target="#join-modal" style="height: 40px">Gabung</button>
                            </div>
                        </div>
                    </div>
                    <hr class="opacity-10 my-4" />
                @endforeach
            </div>
        </div>
    @else
        <div class="row mt-5 pt-5">
            <div class="col-lg-4 position-absolute top-50 start-50 translate-middle">
                <form action="{{ route('search') }}" method="post">
                    @csrf
                    <div class="input-group">
                        <input type="text" class="form-control border-end-0 shadow-none fs-5 py-2 px-3"
                            name="search-business" placeholder="Cari perusahaan">
                        <button type="submit" class="input-group-text border-start-0 bg-white fs-5" id="search-business"><i
                                class="bi bi-search"></i></button>
                    </div>
                    <div class="btn-group mx-auto width-100 mt-3" role="group" aria-label="Basic radio toggle button group">
                        <input type="radio" class="btn-check" name="search-radio" id="startup-radio" autocomplete="off"
                            value="startup">
                        <label class="btn btn-outline-primary" for="startup-radio">Startups</label>

                        <input type="radio" class="btn-check" name="search-radio" id="venture-radio" autocomplete="off"
                            value="venture">
                        <label class="btn btn-outline-primary" for="venture-radio">Perusahaan</label>
                    </div>
                </form>
            </div>
        </div>
    @endif
@endsection
