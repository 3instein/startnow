@extends('layouts.app')

@push('addon-style')
    <style>
        #phone_number::-webkit-outer-spin-button,
        #phone_number::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
    </style>
@endpush

@section('body')
    @if (!auth()->user()->typeable_id)
    <div class="login-form position-absolute top-50 start-50 translate-middle text-center col-lg-3">
        <h1>Join our community of growing startups</h1>
        <p class="mb-5">Colaborate and share business ideas</p>
        <form action="{{ route('startups.store') }}" method="POST">
        @csrf
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="name" name="name" class="form-control shadow-none" id="name" placeholder="name@example.com" autofocus autocomplete="off">
                    <label for="name">Nama start up</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="dropdown">
                    <select class="form-select shadow-none py-3" name="category_id" aria-label="Default select example">
                    <option selected hidden>Bidang start up</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                    </select>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="text" name="address" name="address" class="form-control shadow-none" id="address" placeholder="name@example.com" autocomplete="off">
                    <label for="address">Alamat kantor</label>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-floating">
                    <input type="number" name="contact" name="contact" class="form-control shadow-none" id="contact" placeholder="name@example.com" autocomplete="off">
                    <label for="contact">Nomor telepon kantor</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary mb-5 bg-base-color fw-bold">Join Now</button>
        </form>
    </div>
    @else
    <div class="login-form position-absolute top-50 start-50 translate-middle text-center col-lg-3">
        {{ auth()->user()->typeable->name }}
        {{ auth()->user()->typeable->category->name }}
        {{ auth()->user()->typeable->address }}
        {{ auth()->user()->typeable->contact }}
    </div>
    @endif
@endsection