<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Response;
use Auth;
use Hash;
use App;
use Illuminate\Support\Facades\Route;


class AccountsController extends Controller
{
	//
	public function __construct(){
		$locale = get_locale();
		App::setLocale($locale);
		$this->middleware('auth');
        $this->middleware('isActive');
	}
	public function index() {
		$users = User::paginate(10);
		$locale = get_locale();
  		App::setLocale($locale);
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
	public function Edit($id) {
		$user = User::find($id);
		$roles = Role::all();
		$locale = get_locale();
  App::setLocale($locale);
		return view('admin.accounts.edit')->with(compact('roles','user'));

	}
	public function profile() {
		$user = User::find(Auth::user()->id);
		return view('admin.accounts.profile')->with(compact('user'));

	}
	public function editProfile(Request $request){
		$id = Auth::user()->id;
		$this->validate($request, [
			'name' => 'required|string|min:8|max:255',
			'email' => "required|email|max:255|unique:users,email,$id",
		]);
		
		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->save();
		return back()->with('success','Profile Updated Successfully');
	}
	public function update(Request $request,$id) {
		$this->validate($request, [
			'name' => 'required|string|min:8|max:255',
			'email' => "required|email|max:255|unique:users,email,$id",
		]);
		if ($request->input('active')) {
			$active_stat = 1;
		}else{
			$active_stat = 0;
		}
		// $active = $request->input('active');
		// $active_stat = $active = 'on' ? '1' : '0' ; 
		$user = User::find($id);
		$user->name = $request->input('name');
		$user->email = $request->input('email');
		$user->active = $active_stat;
		$user->roles()->detach();
		$user->roles()->attach($request->input('role'));
		$user->save();
		return back()->with('success','Account Updated Successfully');
	}
	public function changePassword(Request $request) {
		$this->validate($request, [
				'oldPassword' => 'required',
				//'password' => 'required|min:8|confirmed',
			]);
			$old_password = $request->input('oldPassword');
			$newpassword = $request->input('password');
			$user = User::find(Auth::user()->id);
			$hashedPassword = $user->password;
			if (Hash::check($old_password, $hashedPassword)) {
				$user->password = bcrypt($newpassword);
				$user->save();
				return back()->with('success','Password Changed Successfully');
			}else{
				return back()->with('faild','Old Password Is Wrong');
			}

	}
	public function delete(Request $request) {
		
		$user_id = $request->input('user_id');
		$user = User::find($user_id);
		$user->roles()->detach();
		$user->delete();
		return response('true',200);
	}
}
