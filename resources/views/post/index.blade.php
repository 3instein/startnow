{{-- @dd($postVoter) --}}
@extends('index')

@section('post')
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 px-4 py-3 mb-3">
                <h3 class="fw-bold pt-3">{{ $post->title }}</h3>
                <div class="card-post-details d-flex my-4 justify-content-between">
                    <div class="d-flex">
                        <img src="{{ Storage::url($post->user->profile_photo_path) == '/storage/' ? asset('icons/default-user-photo.png') : Storage::url($post->user->profile_photo_path) }}"
                            class="user-icon rounded-50">
                        <div class="card-post-details-user ms-3">
                            <p class="m-0 fw-bold">
                                {{ $post->user->name }}
                                @if ($post->user->typeable)
                                    <small class="text-muted fw-normal"> - {{ $post->user->position }}
                                        <span>@</span>{{ $post->user->typeable->name }}</small>
                                @endif
                            </p>
                            <small class="text-muted opacity-50">Posted {{ $post->created_at->diffForHumans() }} in
                                {{ $post->category->name }}</small>
                        </div>
                    </div>
                    <div class="dropdown">
                        <button class="btn btn-secondary border-0 bg-white text-dark shadow-none" type="button" id="report"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-three-dots icon"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end p-0" aria-labelledby="report">
                            <li><a class="dropdown-item" href="#">Laporkan</a></li>
                        </ul>
                    </div>
                </div>
                <img src="{{ Storage::url($post->thumbnail_path) }}" class="card-img-top rounded border"
                    style="width: 808px; height: 480px; object-fit: cover;">
                <div class="mt-4 mb-2">
                    {!! $post->body !!}
                </div>
                <div class="d-flex mb-4">
                    <small class="text-muted me-4"><i class="bi bi-eye-fill me-1"></i><small
                            class="text-view">{{ $post->views }}</small> viewers</small>
                    <small class="text-muted me-4"><i class="bi bi-arrow-up-circle-fill me-1"></i><small
                            class="text-upvote">{{ $post->upvote }}</small> upvoters</small>
                    <small class="text-muted"><i class="bi bi-arrow-down-circle-fill me-1"></i><small
                            class="text-downvote">{{ $post->downvote }}</small> downvoters</small>
                </div>
                <div class="d-flex justify-content-end">
                    <div class="d-flex rounded" role="group" aria-label="Basic outlined example"
                        style="border: 1px solid #C6CACD">
                        @if ($postVoter)
                            <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form width-100"
                                method="POST" style="border-right: 1px solid #C6CACD">
                                @csrf
                                <input type="hidden" name="type" value="upvote">
                                <button
                                    class="border-0 bg-transparent px-2 py-1 text-dark fw-bold shadow-none d-flex align-items-center width-100 me-3"
                                    id="btn-upvote">
                                    <i
                                        class="bi {{ $postVoter->type == 'upvote' ? 'bi-arrow-up-circle-fill' : 'bi-arrow-up-circle' }} text-base-color fs-5 me-2"></i>
                                    upvote
                                </button>
                            </form>
                            <div class="align-self-center justify-self-center" style="border-right: 1px solid #C6CACD">
                                <button type="button"
                                    class="border-0 bg-transparent px-2 py-1 text-dark fw-bold shadow-none d-flex align-items-center width-100 me-3"
                                    id="show-comment">
                                    <i class="bi bi-chat-right-dots text-base-color me-2"></i>
                                    Komentari
                                </button>
                            </div>
                            <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form width-100">
                                @csrf
                                <input type="hidden" name="type" value="downvote">
                                <button
                                    class="border-0 bg-transparent px-2 py-1 text-dark fw-bold shadow-none d-flex align-items-center width-100"
                                    id="btn-downvote">
                                    <i
                                        class="bi {{ $postVoter->type == 'downvote' ? 'bi-arrow-down-circle-fill' : 'bi-arrow-down-circle' }} text-base-color fs-5 me-2"></i>
                                    downvote
                                </button>
                            </form>
                        @else
                            <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form width-100"
                                method="POST" style="border-right: 1px solid #C6CACD">
                                @csrf
                                <input type="hidden" name="type" value="upvote">
                                <button
                                    class="border-0 bg-transparent px-2 py-1 text-dark fw-bold shadow-none d-flex align-items-center width-100 me-3"
                                    id="btn-upvote">
                                    <i class="bi bi-arrow-up-circle text-base-color fs-5 me-2"></i>
                                    upvote
                                </button>
                            </form>
                            <div class="align-self-center justify-self-center" style="border-right: 1px solid #C6CACD">
                                <button type="button"
                                    class="border-0 bg-transparent px-2 py-1 text-dark fw-bold shadow-none d-flex align-items-center width-100 me-3"
                                    id="show-comment">
                                    <i class="bi bi-chat-right-dots text-base-color me-2"></i>
                                    Komentari
                                </button>
                            </div>
                            <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form width-100">
                                @csrf
                                <input type="hidden" name="type" value="downvote">
                                <button
                                    class="border-0 bg-transparent px-2 py-1 text-dark fw-bold shadow-none d-flex align-items-center width-100"
                                    id="btn-downvote">
                                    <i class="bi bi-arrow-down-circle text-base-color fs-5 me-2"></i>
                                    downvote
                                </button>
                            </form>
                        @endif
                    </div>
                </div>
            </div>
            <hr class="opacity-10" />
            <div class="card border-0 px-4 mb-3 py-4 position-relative d-none" id="comment-section">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <textarea class="form-control shadow-none" name="body" placeholder="Leave a comment here" id="body"
                            style="height: 100px" autofocus></textarea>
                        <label for="body">Comment</label>
                    </div>
                    <input type="hidden" name="post_id" value="{{ $post->id }}">
                    <div class="text-end">
                        <button type="submit" class="btn bg-base-color text-white fw-bold" id="comment"
                            style="border: 1px solid #C6CACD">
                            <i class="bi bi-chat-right-text-fill me-2"></i>
                            Tambah Komentar
                        </button>
                    </div>
                </form>
            </div>
            <hr class="opacity-10 d-none" id="comment-line" />
            @foreach (collect($post->comments)->sortDesc() as $comment)
                <div class="card border-0 px-4 position-relative" id="card-comment">
                    <div class="card-post-details d-flex my-4 justify-content-between">
                        <div class="d-flex">
                            <img src="{{ Storage::url($comment->user->profile_photo_path) == '/storage/' ? asset('icons/default-user-photo.png') : Storage::url($comment->user->profile_photo_path) }}"
                                class="user-icon rounded-circle">
                            <div class="card-post-details-user ms-3">
                                <p class="m-0 fw-bold">{{ $comment->user->name }}</p>
                                <small class="text-muted opacity-50">Commented
                                    {{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                        <div class="dropdown">
                            <button class="btn btn-secondary border-0 bg-white text-dark shadow-none" type="button"
                                id="report" data-bs-toggle="dropdown" aria-expanded="false">
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
                <hr class="opacity-10" />
            @endforeach
        </div>
    </div>
@endsection

@push('addon-script')
    <script>
        $('.vote-form').submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = form.attr('action');
            let data = form.serialize();

            $.ajax({
                url: url,
                type: 'POST',
                data,
                success: function(data) {
                    data = JSON.parse(data);
                    if (data.status === 'success') {
                        let parent = form.parent().parent().parent();

                        parent.find('.text-upvote').text(data.upvote);
                        parent.find('.text-downvote').text(data.downvote);

                        if (data.type === 'upvote') {
                            document.getElementById('btn-upvote').querySelector('i').classList.remove(
                                'bi-arrow-up-circle');
                            document.getElementById('btn-upvote').querySelector('i').classList.add(
                                'bi-arrow-up-circle-fill');
                            document.getElementById('btn-downvote').querySelector('i').classList.remove(
                                'bi-arrow-down-circle-fill');
                            document.getElementById('btn-downvote').querySelector('i').classList.add(
                                'bi-arrow-down-circle');
                        } else {
                            document.getElementById('btn-upvote').querySelector('i').classList.remove(
                                'bi-arrow-up-circle-fill');
                            document.getElementById('btn-upvote').querySelector('i').classList.add(
                                'bi-arrow-up-circle');
                            document.getElementById('btn-downvote').querySelector('i').classList.remove(
                                'bi-arrow-down-circle');
                            document.getElementById('btn-downvote').querySelector('i').classList.add(
                                'bi-arrow-down-circle-fill');
                        }
                    }
                }
            });
        });

        $('#show-comment').click(function() {
            $('#comment-section').removeClass('d-none');
            $('#comment-line').removeClass('d-none');
        })
    </script>
@endpush
