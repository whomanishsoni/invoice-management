<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'hsn_code',
        'grade',
        'purchase_price',
        'tax_rate_id',
        'tax_amount',
        'sale_price',
    ];

    public $timestamps = true;

    public function tax()
    {
        return $this->belongsTo(Tax::class, 'tax_rate_id');
    }

    public function rawanaItems()
    {
        return $this->hasMany(RawanaItem::class);
    }
}
