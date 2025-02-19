<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    protected $table = 'vendors';

    protected $fillable = [
        'name',
        'email',
        'phone',
        'address',
        'city',
        'state_id',
        'gst_number',
    ];

    public $timestamps = true;

    public function state()
    {
        return $this->belongsTo(State::class);
    }
}
