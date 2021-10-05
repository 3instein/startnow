@extends('layouts.app')

@section('body')
<div class="row pt-5 mt-5">
  <div class="col-lg-12 mt-5">
    <div class="text-center">
      <small class="text-muted fw-bold opacity-50">Published {{ $post->created_at->diffForHumans() }}</small>
      <h1 class="fw-bold">{{ $post->title }}</h1>
    </div>
  </div>
</div>
@endsection