<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    use HasFactory, HasUuids;

    protected $guarded = [
        'id',
    ];


    public function sale()
    {
        return $this->hasMany(Sale::class);
    }

    public function bill()
    {
        return $this->hasMany(Bill::class);
    }

    public function product()
    {
        return $this->hasMany(Product::class);
    }
}
