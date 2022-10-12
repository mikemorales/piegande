<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up() {
        Schema::create( 'products', function ( Blueprint $table ) {
            $table->id();
            $table->foreignId( 'model_id' )->references( 'id' )->on( 'model_shoes' );
            $table->foreignId( 'brand_id' )->references( 'id' )->on( 'brands' );
            $table->foreignId( 'category_id' )->references( 'id' )->on( 'categories' );
            $table->string( 'sku', 250 );
            $table->string( 'picture', 255 );
            $table->integer( 'quantity' );
            $table->double( 'price', 10, 2 );
            $table->string( 'size', 50 )->nullable();
            $table->integer( 'status' )->default( 1 );
            $table->timestamps();
        } );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down() {
        Schema::dropIfExists( 'products' );
    }
};
