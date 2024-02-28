<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingCharge extends Model
{
    protected $table = "shipping_charges";
    use HasFactory;
    protected $guarded=[
        'id'
      ];


    public function city()
    {
        return $this->belongsTo(City::class,'city_id');
    }
}
