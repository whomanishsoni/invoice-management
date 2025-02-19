<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{
    protected $table = 'vehicles';

    protected $fillable = [
        'vehicle_number',
        'contact_person',
        'contact_phone',
        'driver_name',
        'driver_phone',
    ];

    public $timestamps = true;

    public function rawanas()
    {
        return $this->hasMany(Rawana::class);
    }
}
