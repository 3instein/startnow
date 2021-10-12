<?php

namespace App\Http\Controllers;

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
        return response()->json(Post::all());
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
            'body' => ['required'],
            'user_id' => ['required', 'exists:App\Models\User,id']
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);

        if ($request->file('thumbnail_path')) {
            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));
        if($post = Post::create($validatedData)){
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
        return Post::find($id) ? response()->json(Post::find($id)) : response()->json([
            'status_message' => 'Resource not found',
            'status_code' => 404
        ], 404);
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
        if(!$post = Post::find($id)){
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
        
        if($post->update($validatedData)){
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
        if(Post::destroy($id)){
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
}
