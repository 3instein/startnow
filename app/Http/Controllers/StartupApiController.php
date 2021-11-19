<?php

namespace App\Http\Controllers;

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
        $startups = Startup::with('users')->get();
        return $startups;
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
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
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
        $startup = Startup::whereId($startup->id)->with('users')->first();
        return $startup;
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

    public function members(Startup $startup){
        return $startup->users;
    }
}
