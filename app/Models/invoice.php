<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class invoice extends Model
{
    use HasFactory;
    protected $fillable = ['date', 'due_date',  'client_id', 'status','company_id','type',];
    protected $casts = [
        'date' => 'datetime',
        'due_date' => 'datetime',
    ];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
    
    public function companyinfo()
    {
        return $this->belongsTo(Companyinfo::class);
    }
    
    public function invoice_items()
    {
        return $this->hasMany(invoice_item::class);
    }

    public function updateTotalAmount()
    {
        $this->total_amount = $this->invoice_items->sum(function ($item) {
            return $item->quantity * $item->unit_price;
        });
        $this->save();
    }
    public function getTotalAmountAttribute()
    {
        return $this->invoice_items->sum(function($item) {
            return $item->unit_price * $item->quantity;
        });
    }

  
}
