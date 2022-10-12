<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Product extends Model {
    use HasFactory;

    protected $fillable = [
        'model_id',
        'brand_id',
        'category_id',
        'sku',
        'picture',
        'quantity',
        'price',
        'name',
        'size',
    ];

    public function relmodelshoe(): HasOne {
        return $this->hasOne( ModelShoe::class, 'id', 'model_id' );
    }

    public function relbrandshoe(): HasOne {
        return $this->hasOne( Brand::class, 'id', 'brand_id' );
    }

    public function relcategoryshoe(): HasOne {
        return $this->hasOne( Category::class, 'id', 'category_id' );
    }

    public function relproductsize(): BelongsToMany {
        return $this->belongsToMany( SizeProduct::class, 'rel_size_products', 'product_id', 'size_id' );
    }

    protected function data(): Attribute {

        return Attribute::make(

            get: fn( $value ) => json_decode( $value, true ),

            set: fn( $value ) => json_encode( $value ),

        );

    }
}
