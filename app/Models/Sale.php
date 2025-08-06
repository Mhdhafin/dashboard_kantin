<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];

   public function reseller()
   {
        return $this->belongsTo(Reseller::class);
    
   }

    public function saleItems()
{
    return $this->hasMany(Sale_item::class);
}

   public function bill()
   {
    return $this->belongsTo(Bill::class);
   }

}
