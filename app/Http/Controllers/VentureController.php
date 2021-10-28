<?php

namespace App\Http\Controllers;

use App\Models\Venture;
use Illuminate\Http\Request;

class VentureController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('venture.index', );
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
			'position' => 'CEO',
			'typeable_id' => $venture->id,
			'typeable_type' => 'App\Models\Venture'
		]);

		return redirect()->route('home');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function show(Venture $venture) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function edit(Venture $venture) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venture $venture) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Venture  $venture
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venture $venture) {
        //
    }

    public function members() {
        return view('venture.members');
    }
}
