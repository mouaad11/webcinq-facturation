<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice_item extends Model
{
    use HasFactory;

    protected $fillable = [
        'invoice_id', 'description', 'quantity', 'unit_price', 'tva',
    ];

    protected static function boot()
    {
        parent::boot();

        static::saved(function ($item) {
            $item->invoice->updateTotalAmount();
        });

        static::deleted(function ($item) {
            $item->invoice->updateTotalAmount();
        });
    }
    public function invoice()
    {
        return $this->belongsTo(Invoice::class);
    }

}
