<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale_item extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];

    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }
    

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
