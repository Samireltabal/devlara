<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Auth;
use App\User;
use App\Items;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('isActive');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.home.index');
    }
    public function lang(Request $request) {
        $user_id = Auth::user()->id;
        $lang = $request->input('lang');
        $user = User::find($user_id);
        $user->locale = $lang;
        $user->save();
        return back();
    }
    public function sn(Request $request) {
        $sn = $request->input('sn');
        $item = Items::where('sn','=',$sn)->get();
        return view('admin.home.sn',compact('item'));
    }
}
