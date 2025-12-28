<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Penalties extends Model
{
    protected $guarded = ['id'];

    // relasi ke car
    public function car()
    {
        return $this->belongsTo(Car::class, 'id_car', 'id');
    }

    // relasi ke car return
    public function carReturns()
    {
        return $this->hasMany(CarReturn::class);
    }
}
