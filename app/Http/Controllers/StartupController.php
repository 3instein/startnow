<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Startup;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;

class StartupController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        return view('startup.index', [
            'startups' => Startup::all(),
            'categories' => Category::all()
        ]);
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

        $startup = Startup::create($validatedData);

        $request->user()->update([
            'typeable_id' => $startup->id,
            'typeable_type' => 'App\Models\Startup'
        ]);

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function show(Startup $startup) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function edit(Startup $startup) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Startup $startup) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Startup  $startup
     * @return \Illuminate\Http\Response
     */
    public function destroy(Startup $startup) {
        //
    }

    public function members() {
        if (request()->ajax()) {
            $query = User::where('typeable_id', auth()->user()->typeable_id)->get();
            return DataTables::of($query)
                ->addColumn('action', function ($user) {
                    return '
                            <form action="' . route('startups.destroy', $user->id) . '" method="POST">
                                ' . method_field('delete') . csrf_field() . '
                                <button type="submit" class="btn btn-danger">
                                    Delete
                                </button>
                            </form>
                    ';
                })
                ->rawColumns(['action'])
                ->make();
        }
        
        return view('startup.members');
    }
}
