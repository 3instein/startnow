@extends('layouts.app')

@section('body')
    <div class="row mt-5 pt-5">
      <div class="col-lg-6 mx-auto">
        <form action="" method="post">
          @csrf
          <div class="input-group">
            <input type="text" class="form-control border-end-0 shadow-none" name="search" placeholder="Cari perusahaan">
            <button type="submit" class="input-group-text border-start-0 bg-white" id="search"><i class="bi bi-search"></i></button>
          </div>
        </form>
      </div>
    </div>
@endsection