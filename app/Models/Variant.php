<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;
    
    protected $table = 'variants';

    protected $fillable = [
        'name',
    ];

    public function variantOptions()
    {
        return $this->hasMany(VariantOption::class, 'variant_id');
    }
}
