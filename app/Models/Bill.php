<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bill extends Model
{
    use HasFactory, HasUuids, SoftDeletes;

    protected $guarded = ['id'];

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }

    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function payment()
    {
        return $this->hasMany(Payment::class);
    }

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
