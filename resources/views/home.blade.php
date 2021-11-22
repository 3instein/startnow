{{-- @dd($postVoters) --}}
@extends('index')

@section('post')
    <h2 class="fw-bolder @if (!$posts->count()) mt-5 @endif">Post & Diskusi</h2>
    @auth
        <a href="{{ route('posts.create') }}"
            class="border-bottom text-decoration-none form-control mb-4 text-center shadow-none">
            <i class="bi bi-plus-circle-fill text-base-color me-1"></i>
            Buat Post Baru
        </a>
    @endauth
    @if ($posts->count())
        <input type="hidden" id="post-voters" value="{{ $postVoters }}">
        @foreach ($posts as $post)
            <div class="card border-0 d-flex flex-row hot-card">
                <img src="{{ Storage::url($post->thumbnail_path) }}" class="card-img-top post-thumbnail rounded border"
                    style="object-fit: cover; ">
                <div class="card-body py-0">
                    <div class="d-flex flex-column justify-content-between" style="height: 100%">
                        <div>
                            <small class="d-flex text-muted justify-content-between" style="height: 22px">
                                <p class="mb-0 fs-12">{{ $post->type->name }}</p>
                                <p class="d-flex align-items-center mb-2 fs-12">
                                    <i class="bi bi-clock-history me-2"></i>
                                    {{ str_replace(['hours', 'hour', 'ago'], ['jam', 'jam', 'lalu'], $post->created_at->diffForHumans()) }}
                                </p>
                            </small>
                            <h5><a href="{{ route('posts.show', $post) }}"
                                    class="card-title text-decoration-none text-dark m-0 fw-bold">{{ $post->title }}</a>
                            </h5>
                            <small class="my-2">{{ $post->excerpt }}</small>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="details d-flex justify-content-end">
                                <div class="d-flex align-items-center">
                                    @auth
                                        <small class="me-3">
                                            <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form"
                                                method="POST">
                                                @csrf
                                                <input type="hidden" name="type" value="upvote">
                                                <button class="bg-white border-0 d-flex align-items-center">
                                                    <i class="bi bi-arrow-up-circle text-base-color fs-24 me-2"></i>
                                                    <span class="text-dark text-upvote fs-6">{{ $post->upvote }}</span>
                                                </button>
                                            </form>
                                        </small>
                                        <small class="text-dark fs-5">
                                            <form action="{{ route('posts.vote', $post->slug) }}" class="vote-form">
                                                @csrf
                                                <input type="hidden" name="type" value="downvote">

                                                <button class="bg-white border-0 d-flex align-items-center">
                                                    <i class="bi bi-arrow-down-circle text-base-color fs-24 me-2"></i>
                                                    <span class="text-dark text-downvote fs-6">{{ $post->downvote }}</span>
                                                </button>
                                            </form>
                                        </small>
                                    @endauth
                                </div>
                            </div>
                            @if ($currentTimestamp->diffInMinutes($post->created_at) < 60)
                                <div class="d-flex align-items-center">
                                    <span class="badge bg-danger">Baru</span>
                                    <a href="{{ route('posts.show', $post) }}"
                                        class="fw-bold text-decoration-none text-base-color border-0 ms-3">Baca
                                        Selengkapnya</a>
                                </div>
                            @else
                                <a href="{{ route('posts.show', $post) }}"
                                    class="fw-bold text-decoration-none text-base-color border-0">Baca Selengkapnya</a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <hr class="opacity-10 my-4" />
        @endforeach
    @else
        <h4 class="text-center text-muted mt-5">No Post(s) Found</h4>
    @endif
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

        let postVoters = document.getElementById('post-voters');
        let data = JSON.parse(postVoters.value);
        console.log(data);
    </script>
@endpush
