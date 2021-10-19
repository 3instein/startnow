<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Startup;
use App\Models\Category;
use App\Models\JoinRequest;
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
            'position' => 'CEO',
            'typeable_id' => $startup->id,
            'typeable_type' => 'App\Models\Startup'
        ]);

        return redirect()->route('home');
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

    public function members(Startup $startup) {
        if (request()->ajax()) {
            if(auth()->user()->typeable_id == $startup->id){
                $query = User::where('typeable_id', auth()->user()->typeable_id)->get();
            } else {
                $query = User::where('typeable_id', $startup->id)->get();
            }
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

    public function join(Request $request, Startup $startup) {
        JoinRequest::create([
            'user_id' => $request->user()->id,
            'typeable_id' => $startup->id,
            'typeable_type' => 'App\Models\Startup'
        ]);        

        return redirect()->route('home');
    }

    public function requests(Startup $startup){
        // return $query = JoinRequest::where('join_requests.typeable_id', auth()->user()->typeable_id)->join('users', 'user_id', 'users.id')->get(['join_requests.*', 'users.name']);
        if (request()->ajax()) {
            if(auth()->user()->typeable_id == $startup->id){
                $query = JoinRequest::where('join_requests.typeable_id', auth()->user()->typeable_id)->join('users', 'user_id', 'users.id')->get(['join_requests.*', 'users.name', 'users.position']);
            } else {
                return redirect()->route();
            }
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
        return view('startup.request');
    }
}
