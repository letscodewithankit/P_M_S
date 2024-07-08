<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class AdminProvider extends Controller
{
    public function index()
    {
        $data=User::all();
        return view('AdminView.AdminProvider',compact('data'));
    }

    public function store(Request $request)
    {
        $validate=$request->validate([
            'email'=>'required',
            'name'=>'required',
            'password'=>'required'
        ]);
        $data=new User();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=$request->password;
        $data->save();

        return redirect()->back()->with('message','done');
    }

    public function update(Request $request)
    {
        $validate=$request->validate([
            'email'=>'required',
            'id'=>'required',
            'email'=>'required',
            'password'=>'required'
        ]);
        $data=User::where('id','=',$request->id)->first();
        $data->name=$request->name;
        $data->email=$request->email;
        $data->password=bcrypt($request->password);
        $data->save();

        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        $validate=$request->validate([
            'id'=>'required'
        ]);


    }
}
