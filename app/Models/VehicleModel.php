<?php

namespace App\Models;

use App\Http\Controllers\ProviderController\VehicleParkedController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VehicleModel extends Model
{
    use HasFactory;
    protected $table='vehicle';

    public function get_parked_data()
    {
       return $this->hasMany(Vehicle_ParkedModel::class,'vehicle_id');
    }
}
