<?php

namespace App\Http\Controllers;

use App\Models\Venture;
use Illuminate\Http\Request;

class VentureApiController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $ventures = Venture::with('users')->get();
        return $ventures;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['required'],
            'address' => ['required', 'string', 'max:255'],
            'contact' => ['required']
        ]);

        $venture = Venture::create($validatedData);

        $request->user()->update([
            'typeable_id' => $venture->id,
            'typeable_type' => 'App\Models\Venture'
        ]);

        return response()->json([
            'venture' => $venture,
            'status_code' => 201
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Venture $venture) {
        $venture = Venture::whereId($venture->id)->with('users')->first();
        return $venture;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function members(Venture $venture) {
        return $venture->users;
    }
}
