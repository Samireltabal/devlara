<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class AccountsController extends Controller
{
    //
	public function __construct() {
		
	}
	public function index() {
		$users = User::all();
		return view('admin.accounts.index');
	}
	public function doAdd(Request $request) {
		
	}
	public function update(Request $request) {
		
	}
	public function suspend(Request $request) {
		
	}
	public function delete(Request $request) {
		
	}
}
