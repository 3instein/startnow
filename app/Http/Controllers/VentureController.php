<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\JoinRequest;
use App\Models\User;
use App\Models\Venture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class VentureController extends Controller {
  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index() {
    return view('venture.index',);
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
      'contact' => ['required'],
      'about' => ['required']
    ]);

    if ($request->file('logo_path')) {
      $validatedData['logo_path'] = $request->file('logo_path')->store('public/startups-logo');
    }

    $validatedData['owner_id'] = $request->user()->id;
    $venture = Venture::create($validatedData);
    $request->user()->update([
      'position' => 'CEO',
      'typeable_id' => $venture->id,
      'typeable_type' => 'App\Models\Venture'
    ]);

    return redirect()->route('ventures.index');
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
    return view('venture.update', [
      'venture' => $venture,
      'categories' => Category::all()
    ]);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Venture  $venture
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, Venture $venture) {
    $validatedData = $request->validate([
      'name' => ['required', 'string', 'max:255'],
      'category_id' => ['required'],
      'address' => ['required', 'string', 'max:255'],
      'contact' => ['required'],
      'about' => ['required']
    ]);

    if ($request->file('logo_path')) {
      if ($request->oldImage) {
        Storage::delete($request->oldImage);
      }

      $validatedData['logo_path'] = $request->file('logo_path')->store('public/ventures-logo');
    }

    $venture->update($validatedData);
    return redirect()->route('ventures.index')->with('success', 'Profil perusahaan berhasil di update');
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

  public function members(Venture $venture) {
    if (request()->ajax()) {
      if (auth()->user()->typeable_id == $venture->id) {
        $query = User::where('typeable_id', auth()->user()->typeable_id)->where('typeable_type', 'App\Models\Venture')->get();
      } else {
        $query = User::where('typeable_id', $venture->id)->where('typeable_type', 'App\Models\Venture')->get();
      }

      return DataTables::of($query)->addColumn('action', function ($user) {
        if ($user->typeable->owner_id == auth()->user()->id) {
          return '
            <form action="' . route('ventures.members.remove', $user) . '" method="POST">
            ' . method_field('delete') . csrf_field() . '
            <button type="submit" class="btn btn-danger">
                Remove
            </button>
        </form>
                  ';
        }
      })->rawColumns(['action'])
        ->make();
    }

    return view('venture.members');
  }

  public function membersRemove(User $user) {
    $user->update([
      'position' => null,
      'typeable_id' => null,
      'typeable_type' => null
    ]);

    return back();
  }

  public function join(Request $request, Venture $venture) {
    JoinRequest::create([
      'user_id' => $request->user()->id,
      'position' => $request->input('position'),
      'typeable_id' => $venture->id,
      'typeable_type' => 'App\Models\Venture'
    ]);

    return redirect()->route('home')->with('success', 'Permintaan berhasil terkirim');
  }

  public function requests(Venture $venture) {
    // return $query = JoinRequest::where('join_requests.typeable_id', auth()->user()->typeable_id)->join('users', 'user_id', 'users.id')->get(['join_requests.*', 'users.name']);
    if (request()->ajax()) {
      if (auth()->user()->typeable_id == $venture->id) {
        $query = JoinRequest::where('join_requests.typeable_id', auth()->user()->typeable_id)->where('join_requests.typeable_type', 'App\Models\Venture')->join('users', 'user_id', 'users.id')->get(['join_requests.*', 'users.name']);
      }

      return DataTables::of($query)
        ->addColumn('action', function ($joinRequest) {
          if ($joinRequest->typeable->owner_id == auth()->user()->id) {
            return '
            <div class="d-flex">
              <a href="' . route('ventures.requests.accept', $joinRequest) . '" class="btn btn-primary bg-base-color border-0 me-3">Accept</a>
                    <form action="' . route('ventures.requests.reject', $joinRequest) . '" method="POST">
                        ' . method_field('delete') . csrf_field() . '
                        <button type="submit" class="btn btn-danger border-0">
                            Reject
                        </button>
                    </form>
                    </div>
            ';
          }
        })
        ->rawColumns(['action'])
        ->make();
    }
    return view('venture.request');
  }

  public function requestsAccept(JoinRequest $joinRequest) {
    $joinRequest->user->update([
      'position' => $joinRequest->position,
      'typeable_id' => $joinRequest->typeable_id,
      'typeable_type' => 'App\Models\Venture'
    ]);

    $joinRequest->delete();
    return back();
  }

  public function requestsReject(JoinRequest $joinRequest) {
    $joinRequest->delete();
    return back();
  }
}
