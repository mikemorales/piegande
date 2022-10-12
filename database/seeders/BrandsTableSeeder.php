<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class BrandsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('brands')->delete();
        
        \DB::table('brands')->insert(array (
            0 => 
            array (
                'id' => 2,
                'name' => 'Flexi',
                'status' => 2,
                'created_at' => '2022-10-11 15:06:44',
                'updated_at' => '2022-10-11 15:06:44',
            ),
            1 => 
            array (
                'id' => 3,
                'name' => 'Penguin',
                'status' => 2,
                'created_at' => '2022-10-11 15:07:01',
                'updated_at' => '2022-10-11 15:07:01',
            ),
            2 => 
            array (
                'id' => 4,
                'name' => 'Roxy',
                'status' => 2,
                'created_at' => '2022-10-11 15:07:10',
                'updated_at' => '2022-10-11 15:07:10',
            ),
            3 => 
            array (
                'id' => 5,
                'name' => 'Volcom',
                'status' => 2,
                'created_at' => '2022-10-11 15:07:19',
                'updated_at' => '2022-10-11 15:07:19',
            ),
            4 => 
            array (
                'id' => 6,
                'name' => 'Reef',
                'status' => 2,
                'created_at' => '2022-10-11 15:07:29',
                'updated_at' => '2022-10-11 15:07:29',
            ),
            5 => 
            array (
                'id' => 7,
                'name' => 'Airwalk',
                'status' => 2,
                'created_at' => '2022-10-11 15:07:48',
                'updated_at' => '2022-10-11 15:07:48',
            ),
        ));
        
        
    }
}