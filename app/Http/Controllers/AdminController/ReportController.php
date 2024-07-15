<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\VehicleModel;

class ReportController extends Controller
{
    public function index()
    {
        $data=VehicleModel::all();
        $data4=User::all();
        return view('AdminView.AdminReport',compact('data','data4'));
    }
}
