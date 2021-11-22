<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Startup;
use App\Models\Category;
use App\Models\JoinRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
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
			'name' => ['required', 'string', 'max:255', 'unique:startups'],
			'category_id' => ['required'],
			'address' => ['required', 'string', 'max:255'],
			'contact' => ['required'],
			'about' => ['required']
		]);

		if ($request->file('logo_path')) {
			$validatedData['logo_path'] = $request->file('logo_path')->store('public/startups-logo');
		}

		$validatedData['owner_id'] = $request->user()->id;
		$startup = Startup::create($validatedData);
		$request->user()->update([
			'position' => 'CEO',
			'typeable_id' => $startup->id,
			'typeable_type' => 'App\Models\Startup'
		]);

		return redirect()->route('startups.index');
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
		return view('startup.update', [
			'startup' => $startup,
			'categories' => Category::all()
		]);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \App\Models\Startup  $startup
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, Startup $startup) {
		$validatedData = $request->validate([
			'name' => ['required', 'string', 'max:255', Rule::unique('startups')->ignore($startup->name, 'name')],
			'category_id' => ['required'],
			'address' => ['required', 'string', 'max:255'],
			'contact' => ['required'],
			'about' => ['required']
		]);

		if ($request->file('logo_path')) {
			if ($request->oldImage) {
				Storage::delete($request->oldImage);
			}

			$validatedData['logo_path'] = $request->file('logo_path')->store('public/startups-logo');
		}

		$startup->update($validatedData);
		return redirect()->route('startups.index')->with('success', 'Profil berhasil di update');
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
			if (auth()->user()->typeable_id == $startup->id) {
				$query = User::where('typeable_id', auth()->user()->typeable_id)->where('typeable_type', 'App\Models\Startup')->get();
			} else {
				$query = User::where('typeable_id', $startup->id)->where('typeable_type', 'App\Models\Startup')->get();
			}

			return DataTables::of($query)
				->addColumn('action', function ($user) {
					if ($user->typeable->owner_id == auth()->user()->id) {
						return '
									<form action="' . route('startups.members.remove', $user) . '" method="POST">
											' . method_field('delete') . csrf_field() . '
											<button type="submit" class="btn btn-danger">
													Remove
											</button>
									</form>
					';
					}
				})
				->rawColumns(['action'])
				->make();
		}

		return view('startup.members');
	}

	public function membersRemove(User $user) {
		$user->update([
			'position' => null,
			'typeable_id' => null,
			'typeable_type' => null
		]);

		return back();
	}

	public function join(Request $request, Startup $startup) {
		JoinRequest::create([
			'user_id' => $request->user()->id,
			'position' => $request->input('position'),
			'typeable_id' => $startup->id,
			'typeable_type' => 'App\Models\Startup'
		]);

		return redirect()->route('home')->with('success', 'Permintaan berhasil terkirim');
	}

	public function requests(Startup $startup) {
		// return $query = JoinRequest::where('join_requests.typeable_id', auth()->user()->typeable_id)->join('users', 'user_id', 'users.id')->get(['join_requests.*', 'users.name']);
		if (request()->ajax()) {
			if (auth()->user()->typeable_id == $startup->id) {
				$query = JoinRequest::where('join_requests.typeable_id', auth()->user()->typeable_id)->where('join_requests.typeable_type', 'App\Models\Startup')->join('users', 'user_id', 'users.id')->get(['join_requests.*', 'users.name']);
			} else {
				// return redirect()->route();
			}
			return DataTables::of($query)
				->addColumn('action', function ($joinRequest) {
					if ($joinRequest->typeable->owner_id == auth()->user()->id) {
						return '
					<div class="d-flex">
						<a href="' . route('startups.requests.accept', $joinRequest) . '" class="btn btn-primary bg-base-color border-0 me-3">Accept</a>
									<form action="' . route('startups.requests.reject', $joinRequest) . '" method="POST">
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
		return view('startup.request');
	}

	public function requestsAccept(JoinRequest $joinRequest) {
		$joinRequest->user->update([
			'position' => $joinRequest->position,
			'typeable_id' => $joinRequest->typeable_id,
			'typeable_type' => 'App\Models\Startup'
		]);

		$joinRequest->delete();
		return back();
	}

	public function requestsReject(JoinRequest $joinRequest) {
		$joinRequest->delete();
		return back();
	}
}
