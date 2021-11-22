@extends('layouts.app')

@section('body')
    <div class="row">
        <div class="col-lg-8 mx-auto my-5 py-5">
            <form action="{{ route('users.update') }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('put')
                <h3>Edit Profil</h3>
                <div class="mb-3">
                    <label for="name" class="form-label @error('name') is-invalid @enderror ">Nama Lengkap</label>
                    <input type="text" class="form-control shadow-none" id="name" name="name"
                        value="{{ old('name', $user->name) }}" required autofocus>
                    @error('name')
                        <div class="text-start invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="username" class="form-label @error('username') is-invalid @enderror ">Username</label>
                    <input type="text" class="form-control shadow-none" id="username" name="username"
                        value="{{ old('username', $user->username) }}" required autofocus>
                    @error('username')
                        <div class="text-start invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label @error('email') is-invalid @enderror ">Email</label>
                    <input type="text" class="form-control shadow-none" id="email" name="email"
                        value="{{ old('email', $user->email) }}" required autofocus>
                    @error('email')
                        <div class="text-start invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="profile_photo_path"
                        class="form-label @error('profile_photo_path') is-invalid @enderror">Foto
                        Profil</label>
                    <img class="img-preview img-fluid mb-3 col-sm-5">
                    <input class="form-control shadow-none" type="file" id="profile_photo_path" name="profile_photo_path"
                        onchange="previewImage()">
                    @error('profile_photo_path')
                        <div class="invalid-feedback">
                            {{ $message }}
                        </div>
                    @enderror
                </div>
                <div class="width-100 text-end">
                    <a href="{{ route('home') }}"
                        class="btn bg-base-color text-decoration-none text-white me-3">Kembali</a>
                    <button type="submit" class="btn bg-base-color text-decoration-none text-white">Perbarui Profil</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        function previewImage() {
            const image = document.querySelector('#profile_photo_path');
            const imagePreview = document.querySelector('.img-preview');

            imagePreview.style.display = 'block';
            imagePreview.style.width = '128px';
            imagePreview.style.height = '128px';

            const ofReader = new FileReader();
            ofReader.readAsDataURL(image.files[0]);

            ofReader.onload = function(ofREvent) {
                imagePreview.src = ofREvent.target.result;
            };
        }
    </script>
@endpush
