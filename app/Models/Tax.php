<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tax extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'rate',
        'cgst_rate',
        'sgst_rate',
    ];

    public $timestamps = true;

    /**
     * Automatically calculate CGST and SGST rates when creating/updating.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($tax) {
            $tax->calculateSplitRates();
        });

        static::updating(function ($tax) {
            $tax->calculateSplitRates();
        });
    }

    /**
     * Calculate CGST and SGST based on the total rate.
     */
    public function calculateSplitRates()
    {
        if ($this->rate > 0) {
            $this->cgst_rate = $this->rate / 2;
            $this->sgst_rate = $this->rate / 2;
        }
    }

    public function products()
    {
        return $this->hasMany(Product::class, 'tax_rate_id');
    }
}
