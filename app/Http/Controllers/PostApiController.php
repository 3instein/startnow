<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\PostViewer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::join('users', 'user_id', 'users.id')
            ->orderBy('posts.id')
            ->get([
                'posts.*', 'users.name', 'users.profile_photo_path'
            ]);
        for ($i = 0; $i < $posts->count(); $i++) {
            $posts[$i]['body'] = strip_tags($posts[$i]['body']);
        }
        return response()->json(
            $posts
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required', 'exists:App\Models\Category,id'],
            'thumbnail_path' => ['required'],
            'body' => ['required']
        ]);

        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);

        if ($request->file('thumbnail_path')) {
            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));
        if ($post = Post::create($validatedData)) {
            return response()->json([
                'post' => $post, 'status_code' => 201
            ], 201);
        } else {
            return response()->json([
                'status_message' => 'Conflict in Request',
                'status_code' => 409
            ], 409);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user_id = auth()->user()->id;
        $post_id = Post::find($id)->id;
        if (!PostViewer::where('user_id', $user_id)->where('post_id', $post_id)->get()->count()) {
            PostViewer::create([
                'post_id' => $post_id,
                'user_id' => $user_id
            ]);
            $post = Post::find($post_id);
            $post->update([
                'views' => $post->views + 1
            ]);
        }
        if ($post = Post::whereKey($id)
            ->join('users', 'user_id', 'users.id')
            ->first([
                'posts.*', 'users.name', 'users.profile_photo_path'
            ])
        ) {
            $post->body = strip_tags($post->body);
            $comments = Comment::where('post_id', $id)
                ->join('users', 'user_id', 'users.id')
                ->get([
                    'comments.*', 'users.name', 'users.profile_photo_path'
                ]);

            return response()->json(
                [
                    'post' => $post,
                    'comments' => $comments
                ]
            );
        } else {
            return response()->json([
                'status_message' => 'Resource not found',
                'status_code' => 404
            ], 404);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!$post = Post::find($id)) {
            return response()->json([
                'status_message' => 'Resource not found',
                'status_code' => 404
            ], 404);
        }
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required'],
            'body' => ['required'],
        ]);

        if ($request->file('thumbnail_path')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = $post->user_id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));

        if ($post->update($validatedData)) {
            return [
                'post' => Post::find($id),
                'status' => 201
            ];
        } else {
            return response()->json([
                'status_message' => 'Conflict in Request',
                'status_code' => 409
            ], 409);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Post::destroy($id)) {
            return response()->json([
                'status_message' => 'Resource deleted',
                'status_code' => 200
            ]);
        } else {
            return response()->json([
                'status_message' => 'Resource not found',
                'status_code' => 404
            ], 404);
        }
    }

    public function users()
    {
        return Post::where('user_id', auth()->user()->id)
            ->join('users', 'user_id', 'users.id')
            ->orderBy('id', 'DESC')
            ->get(
                [
                    'posts.*', 'users.name'
                ]
            );
    }

    public function vote(Request $request, Post $post)
    {
        $type = $request->type;
        $postVoter = $post->voters()->whereUserId($request->user()->id)->first();

        if ($postVoter) {
            if ($postVoter->type == $type) {
                return response()->json([
                    'status_message' => 'Same type',
                    'status_code' => '400'
                ], 400);
            }

            $postVoter->wherePostId($post->id)->whereUserId($request->user()->id)->update(['type' => $type]);

            if ($type == 'upvote') {
                $post->update([
                    'upvote' => $post->upvote + 1,
                    'downvote' => $post->downvote - 1
                ]);
            } else if ($type == 'downvote') {
                $post->update([
                    'upvote' => $post->upvote - 1,
                    'downvote' => $post->downvote + 1
                ]);
            }
        } else {
            $post->voters()->create([
                'user_id' => $request->user()->id,
                'type' => $type
            ]);

            $value = $type === 'upvote'
                ? ['upvote' => $post->upvote + 1]
                : ['downvote' => $post->downvote + 1];

            $post->update($value);
        }

        return response()->json([
            'status_message' => 'success',
            'upvote' => $post->fresh()->upvote,
            'downvote' => $post->fresh()->downvote,
            'status_code' => 200
        ]);
    }
}
