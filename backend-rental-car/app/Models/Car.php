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
}
