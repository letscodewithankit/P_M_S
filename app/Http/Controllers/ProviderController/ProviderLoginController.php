<?php

namespace App\Http\Controllers\ProviderController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProviderLoginController extends Controller
{

    public function index()
    {
        return view('ProviderView.Login');
    }
    public function login(Request $request)
    {
        $request->validate([
            'email'=>'required',
            'password'=>'required'
        ]);

        if(Auth::guard('web')->attempt([
            'email'=>$request->email,
            'password'=>$request->password
        ]))
        {
            $data=VehicleModel::all();
            return view('ProviderView.Dashboard',compact('data'));
        }
        else
        {
            return redirect()->back()->withErrors('error','Not Valid');
        }



    }
    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
