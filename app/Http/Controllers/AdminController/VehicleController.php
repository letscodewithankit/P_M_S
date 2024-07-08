<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VehicleModel;
use Illuminate\Http\Request;

class VehicleController extends Controller
{
    public function index()
    {
        $data=VehicleModel::all();
        return view('AdminView.AdminVehicle',compact('data'));
    }

    public function store(Request $request)
    {
//        dd($request);
        $validate=$request->validate([
            'type'=>'required',
            'charge'=>'required'
        ]);
        $data=new VehicleModel();
        $data->type=$request->type;
        $data->charges=$request->charge;
        $data->status=1;
        $data->save();

        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validate=$request->validate([
            'type'=>'required',
            'id'=>'required',
            'charge'=>'required',
        ]);
        $data=VehicleModel::where('id','=',$request->id)->first();
        $data->type=$request->type;
        $data->charges=$request->charge;
        $data->save();

        return redirect()->back();

    }

    public function destroy(Request $request)
    {
        VehicleModel::where('id','=',$request->id)->first()->delete();
        return redirect()->back();
    }
}
