@extends('index')

@section('headline')
{{ $post->title }}
@endsection

@section('post')
<div class="card shadow-medium bg-body border-0 px-4 py-3 mb-3">
  <div class="card-post-details d-flex my-4 justify-content-between">
    <div class="d-flex">
      <img src="https://source.unsplash.com/random/50x50" class="user-icon rounded-circle">
      <div class="card-post-details-user ms-3">
        <p class="m-0 fw-bold">{{ $post->user->name }}</p>
        <small class="text-muted opacity-50">Posted {{ $post->created_at->diffForHumans() }}</small>
      </div>
    </div>
    <div class="dropdown">
      <button class="btn btn-secondary border-0 bg-white text-dark shadow-none" type="button" id="report" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots icon"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="report">
        <li><a class="dropdown-item" href="#">Laporkan</a></li>
      </ul>
    </div>
  </div>
  <img src="https://source.unsplash.com/random/760x400" class="card-img-top">
  <div class="mt-4 mb-2">
    {!! $post->body !!}
  </div>
  <div class="d-flex mb-4">
    <small class="text-muted me-4"><i class="bi bi-arrow-up-circle-fill me-1"></i><small class="text-upvote">{{ $post->upvote }}</small> upvotes</small>
    <small class="text-muted"><i class="bi bi-arrow-down-circle-fill me-1"></i><small class="text-downvote">{{ $post->downvote }}</small> downvotes</small>
  </div>
  <div class="btn-group" role="group" aria-label="Basic outlined example">
      <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form width-100" method="POST">
          @csrf
          <input type="hidden" name="type" value="upvote">
          <button class="btn text-dark fw-bold width-100" style="border: 1px solid #C6CACD">
            <i class="bi bi-arrow-up-circle-fill me-2 text-base-color"></i>
            Upvote
          </button>
        </form>
        <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form width-100">
          @csrf
          <input type="hidden" name="type" value="downvote">
          <button class="btn text-dark fw-bold width-100" style="border: 1px solid #C6CACD">
            <i class="bi bi-arrow-down-circle-fill me-2 text-danger"></i>
            Downvote
          </button>
      </form>
  </div>
</div>

<div class="card shadow-medium bg-body border-0 px-4 mb-3 py-4 position-relative">
  <form action="{{ route('comments.store') }}" method="POST">
    @csrf
    <div class="form-floating mb-3">
      <textarea class="form-control" name="body" placeholder="Leave a comment here" id="body" style="height: 100px"></textarea>
      <label for="body">Comment</label>
    </div>
    <input type="hidden" name="post_id" value="{{ $post->id }}">
    <div class="text-end">
      <button type="submit" class="btn bg-base-color text-white fw-bold" id="comment" style="border: 1px solid #C6CACD">
        <i class="bi bi-chat-right-text-fill me-2"></i>
        Post Comment
      </button>
    </div>
  </form>
</div>

@foreach (collect($post->comments)->sortDesc() as $comment)
<div class="card shadow-medium bg-body border-0 px-4 mb-3 position-relative pb-4" id="card-comment">
  <div class="card-post-details d-flex my-4 justify-content-between">
    <div class="d-flex">
      <img src="https://source.unsplash.com/random/50x50" class="user-icon rounded-circle">
      <div class="card-post-details-user ms-3">
        <p class="m-0 fw-bold">{{ $comment->user->name }}</p>
        <small class="text-muted opacity-50">Posted {{ $comment->created_at->diffForHumans() }}</small>
      </div>
    </div>
    <div class="dropdown">
      <button class="btn btn-secondary border-0 bg-white text-dark shadow-none" type="button" id="report" data-bs-toggle="dropdown" aria-expanded="false">
        <i class="bi bi-three-dots icon"></i>
      </button>
      <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="report">
        <li><a class="dropdown-item" href="#">Laporkan</a></li>
      </ul>
    </div>
  </div>
  <div class="pb-1">
    {{ $comment->body }}
  </div>
</div>
@endforeach
@endsection

@push('addon-script')
    <script>
        $('.vote-form').submit(function (e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            let data = form.serialize();
            
            $.ajax({
                url: url,
                type: 'POST',
                data,
                success: function (data) {
                    data = JSON.parse(data);
                    if (data.status === 'success') {
                        let parent = form.parent().parent();

                        parent.find('.text-upvote').text(data.upvote);
                        parent.find('.text-downvote').text(data.downvote);
                    }
                }
            });
        });
    </script>
@endpush
