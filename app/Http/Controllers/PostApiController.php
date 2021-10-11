<?php

namespace App\Http\Controllers;

use App\Models\Post;
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
            'category_id' => ['required'],
            'thumbnail_path' => ['required'],
            'body' => ['required']
        ]);
        
        $validatedData['slug'] = SlugService::createSlug(Post::class, 'slug', $request->title);

        if ($request->file('thumbnail_path')) {
            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));
        if($post = Post::create($validatedData)){
            return ['post' => $post, 'status' => 201];
        } else {
            return ['status' => 409];
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
        return response()->json(Post::find($id));
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
        $post = Post::find($id);
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'category_id' => ['required'],
            'thumbnail_path' => ['required'],
            'body' => ['required']
        ]);

        if ($request->file('thumbnail_path')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = $request->input('user_id');
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));
        
        if($post->update($validatedData)){
            return [
                'post' => Post::find($id),
                'status' => 201
            ];
        } else {
            return 409;
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
            return "success";
        } else {
            return "failed";
        }
    }
}
