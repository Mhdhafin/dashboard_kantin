<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];

    public function saleItems()
    {
        return $this->hasMany(Sale_item::class);

    }

    public function reseller()
    {
        return $this->belongsTo(Reseller::class);
    }
}
