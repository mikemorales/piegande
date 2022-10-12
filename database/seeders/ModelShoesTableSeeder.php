<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class ModelShoesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('model_shoes')->delete();
        
        \DB::table('model_shoes')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Model Cab 1',
                'code' => 'mc1',
                'status' => 2,
                'created_at' => '2022-10-11 14:42:49',
                'updated_at' => '2022-10-11 14:42:49',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Model Cab 2',
                'code' => 'mc2',
                'status' => 2,
                'created_at' => '2022-10-11 15:13:55',
                'updated_at' => '2022-10-11 15:13:55',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'Model Cab 3',
                'code' => 'mc3',
                'status' => 2,
                'created_at' => '2022-10-11 15:14:13',
                'updated_at' => '2022-10-11 15:14:13',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Model Cab 4',
                'code' => 'mc4',
                'status' => 2,
                'created_at' => '2022-10-11 15:14:24',
                'updated_at' => '2022-10-11 15:14:24',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Model Cab 5',
                'code' => 'mc5',
                'status' => 2,
                'created_at' => '2022-10-11 15:14:42',
                'updated_at' => '2022-10-11 15:14:42',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'Model Dam 1',
                'code' => 'md1',
                'status' => 2,
                'created_at' => '2022-10-11 15:14:54',
                'updated_at' => '2022-10-11 15:15:53',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'Model Dam 2',
                'code' => 'md2',
                'status' => 2,
                'created_at' => '2022-10-11 15:15:05',
                'updated_at' => '2022-10-11 15:15:05',
            ),
            7 => 
            array (
                'id' => 8,
                'name' => 'Model Dam 3',
                'code' => 'md3',
                'status' => 2,
                'created_at' => '2022-10-11 15:16:07',
                'updated_at' => '2022-10-11 15:16:07',
            ),
            8 => 
            array (
                'id' => 9,
                'name' => 'Model Dam 4',
                'code' => 'md4',
                'status' => 2,
                'created_at' => '2022-10-11 15:16:17',
                'updated_at' => '2022-10-11 15:16:17',
            ),
            9 => 
            array (
                'id' => 10,
                'name' => 'Model Dam 5',
                'code' => 'md5',
                'status' => 2,
                'created_at' => '2022-10-11 15:16:30',
                'updated_at' => '2022-10-11 15:16:30',
            ),
        ));
        
        
    }
}