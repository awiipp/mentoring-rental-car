<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $guarded = ['id'];

    // relasi ke rent
    public function rents()
    {
        return $this->hasMany(Rent::class);
    }

    // relasi ke penalties
    public function penalties()
    {
        return $this->hasMany(Penalties::class);
    }

    // relasi ke car return
    public function carReturns()
    {
        return $this->hasMany(CarReturn::class);
    }
}
