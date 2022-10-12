<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 14,
                'model_id' => 7,
                'brand_id' => 4,
                'category_id' => 2,
                'name' => 'Georgia Woods',
                'sku' => 'Nam minima ea qui de',
                'picture' => '1665522813-zapato-c-1.png',
                'quantity' => 201,
                'price' => 306.0,
                'size' => '3,5,4.5',
                'status' => 1,
                'created_at' => '2022-10-11 23:14:35',
                'updated_at' => '2022-10-11 23:14:35',
            ),
            1 => 
            array (
                'id' => 15,
                'model_id' => 2,
                'brand_id' => 3,
                'category_id' => 1,
                'name' => 'Keefe Love',
                'sku' => 'Ut in qui sit nostr',
                'picture' => '1665531399-zapato-c-2.png',
                'quantity' => 469,
                'price' => 81.0,
                'size' => '3,5,4.5',
                'status' => 1,
                'created_at' => '2022-10-11 23:36:39',
                'updated_at' => '2022-10-11 23:36:39',
            ),
        ));
        
        
    }
}