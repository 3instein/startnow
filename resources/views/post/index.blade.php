@extends('index')

@section('post')
    <div class="row">
        <div class="col-lg-8">
            <div class="card border-0 px-4 py-3 mb-3">
                <h3 class="fw-bold pt-3">{{ $post->title }}</h3>
                <div class="card-post-details d-flex my-4 justify-content-between">
                    <div class="d-flex">
                        <img src="{{ Storage::url($post->user->profile_photo_path) == '/storage/' ? asset('icons/default-user-photo.png') : Storage::url($post->user->profile_photo_path) }}" class="user-icon rounded-50">
                        <div class="card-post-details-user ms-3">
                            <p class="m-0 fw-bold">
                                {{ $post->user->name }}
                                @if ($post->user->typeable)
                                    <small class="text-muted fw-normal"> - {{ $post->user->position }} <span>@</span>{{ $post->user->typeable->name }}</small>
                                @endif
                            </p>
                            <small class="text-muted opacity-50">Posted {{ $post->created_at->diffForHumans() }} in {{ $post->category->name }}</small>
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
                <img src="{{ Storage::url($post->thumbnail_path) }}" class="card-img-top rounded border" style="width: 808px; height: 480px; object-fit: cover;">
                <div class="mt-4 mb-2">
                    {!! $post->body !!}
                </div>
                <div class="d-flex mb-4">
                    <small class="text-muted me-4"><i class="bi bi-eye-fill me-1"></i><small
                            class="text-view">{{ $post->views }}</small> views</small>
                    <small class="text-muted me-4"><i class="bi bi-arrow-up-circle-fill me-1"></i><small
                            class="text-upvote">{{ $post->upvote }}</small> upvotes</small>
                    <small class="text-muted"><i class="bi bi-arrow-down-circle-fill me-1"></i><small
                            class="text-downvote">{{ $post->downvote }}</small> downvotes</small>
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
            <hr class="opacity-10" />
            <div class="card border-0 px-4 mb-3 py-4 position-relative">
                <form action="{{ route('comments.store') }}" method="POST">
                    @csrf
                    <div class="form-floating mb-3">
                        <textarea class="form-control shadow-none" name="body" placeholder="Leave a comment here" id="body"
                            style="height: 100px"></textarea>
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
            <hr class="opacity-10" />
            @foreach (collect($post->comments)->sortDesc() as $comment)
                <div class="card border-0 px-4 position-relative" id="card-comment">
                    <div class="card-post-details d-flex my-4 justify-content-between">
                        <div class="d-flex">
                            <img src="{{ asset('storage/post-images/' . $comment->user->profile_photo_path) }}" class="user-icon rounded-circle">
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
        <div class="col-lg-4">
            <div class="shadow-medium p-3 bg-body rounded-12 mt-4 rounded-0 sticky-top top-lg-14">
                <div class="card-header bg-white fw-bold fs-5 border-0 d-flex align-items-center">
                    <img src="{{ asset('/icons/hashtag.png') }}" class="icon-hashtag me-3">
                    Trending Topic
                </div>
                <ul class="list-group list-group-flush">
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#1 An
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#2 A
                            second
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#3 A
                            third
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#4 A
                            fourth
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#5 A
                            fifth
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#6 A
                            sixth
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#7 A
                            seventh item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#8 A
                            eight
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#9 A
                            ninth
                            item</a></li>
                    <li class="list-group-item border-0 fs-14"><a href="" class="text-dark text-decoration-none">#10 A
                            tenth
                            item</a></li>
                </ul>
            </div>
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
                        let parent = form.parent().parent();

                        parent.find('.text-upvote').text(data.upvote);
                        parent.find('.text-downvote').text(data.downvote);
                    }
                }
            });
        });
    </script>
@endpush
