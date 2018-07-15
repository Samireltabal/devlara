<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;


class AccountsController extends Controller
{
    //
	public function __construct() {
		
	}
	public function index() {
		$users = User::paginate(10);
		return view('admin.accounts.index')->with('users',$users);
	}
	public function toggle(Request $request) {
		$user_id = $request->input('user_id');
		$user = User::find($user_id);
		$user->toggle()->save();

		return back();
	}
	public function create() {
		$roles = Role::all();
		return view('admin.accounts.form')->with('roles',$roles);
	}
	public function doAdd(Request $request) {
		$this->validate($request, [
				'name' => 'required|string|min:8|max:255',
				'email' => 'required|email|max:255|unique:users',
				'password' => 'required|min:8|confirmed',
				'password_confirmation' => 'required',
			]);
			$active_stat = $request->active = 'on' ? '1' : '0' ; 
			$user = new User;
			$user->name = $request->input('name');
			$user->email = $request->input('email');
			$user->password = bcrypt($request->input('password'));
			$user->active = $active_stat ; 
			$user->locale = null;
			$user->save();
			$user->roles()->attach($request->input('role'));
			return redirect('/accounts');
			
	}
	public function updateRole(Request $request) {
		$role_id = $request->input('role_id');
		return $role_id;

	}
	public function update(Request $request) {
		
	}
	public function suspend(Request $request) {
		
	}
	public function delete(Request $request) {
		$user_id = $request->input('user_id');
		$user = User::find($user_id);
		$user->roles()->detach();
		$user->delete();
		return back();
	}
}
