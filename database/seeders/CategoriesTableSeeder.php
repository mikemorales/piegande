<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('categories')->delete();
        
        \DB::table('categories')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Caballero',
                'status' => 2,
                'created_at' => '2022-10-11 15:08:32',
                'updated_at' => '2022-10-11 15:11:26',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Dama',
                'status' => 2,
                'created_at' => '2022-10-11 15:10:55',
                'updated_at' => '2022-10-11 15:10:55',
            ),
        ));
        
        
    }
}