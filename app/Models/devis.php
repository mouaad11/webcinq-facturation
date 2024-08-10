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

public function invoice_items()
{
    return $this->hasMany(invoice_item::class);
}
   // Define the relationship
   public function devis_items()
   {
       return $this->hasMany(devis_items::class);
   }
}
