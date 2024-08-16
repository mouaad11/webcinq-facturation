<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devis_items extends Model
{
    use HasFactory;

    // Specify the table name if it's not the default 'devis_items'
    protected $table = 'devis_items';

    // The attributes that are mass assignable
    protected $fillable = [
        'devis_id',
        'description',
        'quantity',
        'unit_price',
        'tva',
    ];

    // Define the relationship between DevisItem and Devis
    public function devis()
    {
        return $this->belongsTo(Devis::class, 'devis_id');
    }
    protected static function boot()
{
    parent::boot();

    static::saved(function ($item) {
        $item->devis->updateTotalAmount();
    });

    static::deleted(function ($item) {
        $item->devis->updateTotalAmount();
    });
}

}
