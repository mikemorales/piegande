<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Miguel Angel Morales Solano',
                'email' => 'dgmikemorales@gmail.com',
                'email_verified_at' => NULL,
                'password' => '$2y$10$fabiBh5d4FsK2mhLHq60fuO8Mg/S97NBgAtItpcRT/n5ENJYdbKSG',
                'remember_token' => 'AWtb5ihP1AGGPg6xSHXxrpSiP5ndKyVCtXfjdpwaON9uEPTNjafc4gxt1ekh',
                'created_at' => '2022-10-09 23:58:20',
                'updated_at' => '2022-10-09 23:58:20',
            ),
        ));
        
        
    }
}