<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class devis extends Model
{
    use HasFactory;

    protected $table = 'devis'; // Assurez-vous que c'est le bon nom de table
    protected $primaryKey = 'id'; // Assurez-vous que c'est la bonne clé primaire
    protected $fillable = ['date', 'companyinfo_id',  'client_id',];
    protected $casts = [
        'date' => 'datetime',
    ];
    public function client()
{
    return $this->belongsTo(Client::class);
}

public function companyinfo()
{
    return $this->belongsTo(Companyinfo::class);
}


    public function devis_items()
    {
        return $this->hasMany(devis_items::class, 'devis_id');
    }



public function updateTotalAmount()
{
    $this->total_amount = $this->devis_items->sum(function ($item) {
        return $item->quantity * $item->unit_price;
    });
    $this->save();
}
}
