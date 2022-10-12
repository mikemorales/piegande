<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class SizeProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('size_products')->delete();
        
        \DB::table('size_products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'size' => '3',
                'status' => 2,
                'created_at' => '2022-10-11 20:18:16',
                'updated_at' => '2022-10-11 20:18:16',
            ),
            1 => 
            array (
                'id' => 2,
                'size' => '5',
                'status' => 2,
                'created_at' => '2022-10-11 20:18:40',
                'updated_at' => '2022-10-11 20:18:40',
            ),
            2 => 
            array (
                'id' => 3,
                'size' => '4.5',
                'status' => 2,
                'created_at' => '2022-10-11 20:19:47',
                'updated_at' => '2022-10-11 20:19:47',
            ),
        ));
        
        
    }
}