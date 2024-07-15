<?php

namespace App\Http\Controllers\ProviderController;

use App\Http\Controllers\Controller;
use App\Models\Vehicle_ParkedModel;
use App\Models\VehicleModel;
use Illuminate\Http\Request;
use Carbon\Carbon;

class VehicleParkedController extends Controller
{
    public function index()
    {
        $data=VehicleModel::all();
        return view('ProviderView.Dashboard',compact('data'));
    }
    public function store(Request $request)
    {
      $request->validate([
          'vehicle_id'=>'required',
          'provider_id'=>'required',
          'vehicle_number'=>'required'
      ]);

      $data=new Vehicle_ParkedModel();
      $data->operator_id=$request->provider_id;
      $data->vehicle_id=$request->vehicle_id;
      $data->vehicle_number=$request->vehicle_number;
        $dt = Carbon::now();
      $data->date=$dt->toDateString();
      $data->time=$dt->toTimeString();
      $data->status=1;
      $data->save();


    }

    public function user_parked_data(Request $request)
    {
        $validate=$request->validate([
            'id'=>'required'
        ]);
       $data=VehicleParkedController::where('operator_id','=',$request->id)->first();

       return response()->json($data);
    }
}
