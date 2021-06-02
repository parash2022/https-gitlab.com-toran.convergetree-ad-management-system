<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Role;
use Carbon\Carbon;
use Auth;

use App\Http\Requests\UserRequest;

class UserController extends Controller
{
	public function index()
	{
		$users = User::paginate(10);
		return view('administrator.users.view', compact('users'));
	}

	public function create()
	{
		$roles = Role::get()->except(5);
		return view('administrator.users.create', compact('roles'));
	}

	public function store(UserRequest $request)
	{

		$user = new User;
		$user->name = $request->name;
		$user->email      = $request->email;
		$user->email_verified_at = Carbon::now();
		$user->password   = bcrypt($request->password);
		$user->save();
		$user->role()->sync($request->role);
		return redirect()->route('administrator.users.edit', [$user->id])->with(['alert' => ['class' => 'success', 'msg' => __('New user added!')]]);
	}


	public function edit(Request $request)
	{
		$id = $request->id;
		$user_role = '';
		$user = User::find($id);
		if (!$user) {
			return redirect()->route('administrator.users.index');
		}
		if (isset($user->role[0]->id)) {
			$user_role = $user->role[0];
		}
		$roles = Role::get();
		return view('administrator.users.edit', compact('user', 'roles', 'user_role'));
	}


	public function update(UserRequest $request)
	{

		$id = $request->id;
		$user = User::find($id);

		if (!$user) {
			return route('administrator.users.index');
		}

		// $user->first_name = $request->first_name;
		// $user->last_name  = $request->last_name;
		$user->name		= $request->name;
		$user->email    = $request->email;
		if (strlen(trim($request->password)) > 4) {
			$user->password = bcrypt($request->password);
		}
		$user->save();
		if ($user->id > 1) {
			$user->role()->sync($request->role);
		}

		return redirect()->route('administrator.users.edit', [$user->id])->with(['alert' => ['class' => 'success', 'msg' => __('User data updated!')]]);
	}


	public function delete(Request $request)
	{
		$id = $request->id;
		$user = User::find($id);
		if ($user) {
			if ($user->id == Auth::id()) {
				return redirect()->route('administrator.users.index')->with(['alert' => ['class' => 'danger', 'msg' => __('You can\'t delete yourself!')]]);
			}
			if ($user->id == 1) {
				return redirect()->route('administrator.users.index')->with(['alert' => ['class' => 'danger', 'msg' => __('Restricted to delete primary user!')]]);
			}
			if (isset($user->role)) {
				$user->role()->detach();
			}
			$user->delete();
		}
		return redirect()->route('administrator.users.index')->with(['alert' => ['class' => 'success', 'msg' => __('User deleted!')]]);
	}
}
