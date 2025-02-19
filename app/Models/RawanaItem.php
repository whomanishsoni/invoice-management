<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RawanaItem extends Model
{
    protected $table = 'rawana_items';

    protected $fillable = [
        'rawana_id',
        'product_id',
        'product_name',
        'hsn_code',
        'grade',
        'tax_rate',
        'purchase_price',
        'sale_price',
        'tax_amount',
    ];

    public $timestamps = true;

    public function rawana()
    {
        return $this->belongsTo(Rawana::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
