<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicle_ParkedModel extends Model
{
    use HasFactory;
    protected $table='vehicle_parked';

    public function get_vehicle_data()
    {
        return $this->belongsTo(VehicleModel::class,'vehicle_id');
    }

    public function get_operator_data()
    {
        return $this->belongsTo(User::class,'operator_id');
    }
}
