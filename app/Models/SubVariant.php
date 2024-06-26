<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubVariant extends Model
{
    use HasFactory;

    protected $table = 'sub_variants';

    protected $fillable = [
        'variant_option_id',
        'product_variant_id',
    ];

    public function productVariants()
    {
        return $this->belongsTo(ProductVariant::class);
    }

    public function variantOption()
    {
        return $this->belongsTo(VariantOption::class);
    }
}
