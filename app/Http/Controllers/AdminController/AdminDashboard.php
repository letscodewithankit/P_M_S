<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User;
use DateTime;
use App\Models\Vehicle_ParkedModel;
use Illuminate\Http\Request;

class AdminDashboard extends Controller
{

    
    public function index()
    {
        $add=0;
        $data=Vehicle_ParkedModel::all();
        $length=count($data);
        $data1=User::all();
        $length2=count($data1);
        foreach ($data as $data2)
        {
            $add+=$data2->get_vehicle_data->charges;
        }
        return view('AdminView.AdminDashboard',compact('length','length2','add'));
    }

    public function search_wise_data(Request $request)
    {
        $validate=$request->validate(
            [
                'from'=>'required',
                'to'=>'required'
            ]
        );

        $data=Vehicle_ParkedModel::whereDate('created_at', '>=', $request->from)
            ->whereDate('created_at', '<=', $request->to)
            ->get();

        $add=0;
        foreach ($data as $data2)
        {
            $add+=$data2->get_vehicle_data->charges;
        }
        $fdate = $request->from;
        $tdate = $request->to;
        $datetime1 = new DateTime($fdate);
        $datetime2 = new DateTime($tdate);
        $interval = $datetime1->diff($datetime2);
        $days = $interval->format('%a');

        return response()->json([count($data),$add,$days]);
    }
}
