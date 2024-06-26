<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $table = 'variants';

    protected $fillable = [
        'product_id',
        'name',
    ];

    public function variantOptions()
    {
        return $this->hasMany(VariantOption::class);
    }
}
