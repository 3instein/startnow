<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Cviebrock\EloquentSluggable\Services\SlugService;

class PostController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('post.user.index', [
            'posts' => Post::where('user_id', Auth::id())->get(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        return view('post.user.create', [
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get(),
            'categories' => Category::all()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', 'unique:posts'],
            'category_id' => ['required'],
            'thumbnail_path' => ['image', 'file', 'max:1024'],
            'body' => ['required']
        ]);

        if ($request->file('thumbnail_path')) {
            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));
        Post::create($validatedData);

        return redirect()->route('posts.index')->with('success', 'New post has been added!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post) {
        return view('post.index', [
            'post' => $post,
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post) {
        return view('post.user.update', [
            'post' => $post,
            'categories' => Category::all(),
            'hotPosts' => Post::orderBy('views', 'DESC')->take(4)->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post) {
        $validatedData = $request->validate([
            'title' => ['required', 'max:255'],
            'slug' => ['required', Rule::unique('posts')->ignore($post->slug, 'slug')],
            'category_id' => ['required'],
            'thumbnail_path' => ['image', 'file', 'max:1024'],
            'body' => ['required']
        ]);

        if ($request->file('thumbnail_path')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }

            $validatedData['thumbnail_path'] = $request->file('thumbnail_path')->store('post-images');
        }

        $validatedData['user_id'] = auth()->user()->id;
        $validatedData['excerpt'] = Str::limit(strip_tags($request->body));

        $post->update($validatedData);

        return redirect()->route('posts.index')->with('success', 'Post has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post) {
        $this->authorize('delete', $post);

        $post->delete();

        return back()->with('success', 'Post has been deleted!');
    }

    public function defineSlug(Request $request) {
        $slug = SlugService::createSlug(Post::class, 'slug', $request->title);

        return response()->json(['slug' => $slug]);
    }
}
