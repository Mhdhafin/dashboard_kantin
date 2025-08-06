<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory, HasUuids;

    protected $fillable = [
    'bill_id',
    'amount',
    'paid_at',
    'payment_proof',
    'notes',
];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }


    public function bill()
    {
        return $this->belongsTo(Bill::class);
    }

    // Jika kamu butuh langsung akses reseller dari payment:
    public function reseller()
    {
        return $this->hasOneThrough(Reseller::class, Bill::class, 'id', 'id', 'bill_id', 'reseller_id');
    }
    

    // Di model Payment.php
public function saleItems()
{
    return $this->hasManyThrough(
        Sale_item::class,
        Sale::class,
        'bill_id',     // Foreign key on Sale table
        'sale_id',     // Foreign key on SaleItem table
        'bill_id',     // Local key on Payment table
        'id'           // Local key on Sale table
    );
}
}
