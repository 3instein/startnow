<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Startup;
use Illuminate\Http\Request;

class StartupApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $startups = Startup::withCount('users')->get();

        foreach ($startups as $startup) {
            foreach ($startup->users as $user) {
                foreach ($user->posts as $post) {
                    $startup['views'] += $post->views;
                    $startup['upvotes'] += $post->upvote;
                    $startup['downvotes'] += $post->downvote;
                }
                $user->unsetRelation('posts');
            }
            $startup['category'] = $startup->category->name;
            $startup->unsetRelation('category');
            $startup->unsetRelation('users');
        }

        return response()->json([
            'startup' => $startups
        ]);
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
            'category_id' => ['required'],
            'owner_id' => ['required'],
            'name' => ['required', 'string', 'max:255'],
            'about' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required']
        ]);

        $startup = Startup::create($validatedData);

        $request->user()->update([
            'typeable_id' => $startup->id,
            'typeable_type' => 'App\Models\Startup'
        ]);

        return response()->json([
            'startup' => $startup,
            'status_code' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function show(Startup $startup)
    {
        $startup->load('users');
        $users_count = $startup->users->count();
        $views = 0;
        $upvotes = 0;
        $downvotes = 0;

        // views
        foreach ($startup->users as $user) {
            foreach ($user->posts as $post) {
                $views += $post->views;
                $upvotes += $post->upvote;
                $downvotes += $post->downvote;
            }
            $user->unsetRelation('posts');
        }

        $startup['category'] = $startup->category->name;
        $startup->unsetRelation('category');

        return response()->json([
            'startup' => $startup,
            'users_count' => $users_count,
            'views' => $views,
            'upvotes' => $upvotes,
            'downvotes' => $downvotes
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startup $startup)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startup $startup)
    {
        //
    }

    public function members(Startup $startup)
    {
        return $startup->users;
    }
}
