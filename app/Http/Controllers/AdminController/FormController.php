<?php

namespace App\Http\Controllers\AdminController;

use App\Http\Controllers\Controller;
use App\Models\FormModel;
use App\Models\ServiceModel;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function index()
    {
        $data=ServiceModel::all();
        $data44=FormModel::all();
        return view('AdminView.Form',compact('data','data44'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'data'=>'required'
        ]);



        foreach ($request->data as $renderdata)
        {
            $data=new FormModel();
          $data->full_name=$renderdata['full_name'];
          $data->email=$renderdata['email'];
          $data->mob_number=$renderdata['contact'];
          $data->message=$renderdata['message'];
//          $data->date=$renderdata['date'];
          $data->service=$renderdata['service'];
            $data->save();
        }

        return back();
    }
}
