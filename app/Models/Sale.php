<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    protected $fillable = [
        'rawana_id',
        'date',
        'customer_id',
        'vendor_id',
        'rawana_weight',
        'kanta_weight',
        'rate',
        'total',
        'vehicle_id',
        'reverse_charges',
        'transport_name',
        'date_of_supply',
        'place_of_supply',
        'remark',
        'photo',
    ];

    public $timestamps = true;

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function vendor()
    {
        return $this->belongsTo(Vendor::class, 'vendor_id');
    }

    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    public function rawana()
    {
        return $this->belongsTo(Rawana::class, 'rawana_id');
    }
}
