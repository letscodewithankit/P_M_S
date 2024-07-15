<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminLoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function index()
    {
        return view('AdminView.AdminLogin');
    }

    public function login(Request $request)
    {
        $validate=$request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);
        if(Auth::guard('admin')->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]))
        {

            return redirect(route('admin_dashboard'));
        }
        else
        {
            return redirect()->back()->withErrors('error','Not Valid');
        }
    }
    public function logout(Request $request) {
        Auth::logout();
        return redirect('/admin/login');
    }
}
