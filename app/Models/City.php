<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $fillable = [
        'name',
        'descripcion',
    ];
    public function citizens()
    {
        return $this->hasMany(Citizen::class);
    }
}
