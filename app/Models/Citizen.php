<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Citizen extends Model
{
    protected $fillable = [
        'first_name', 
        'last_name', 
        'birth_date', 
        'address', 
        'phone', 
        'city_id'
    ];

    public function city()
    {
        return $this->belongsTo(City::class);
    }
}
