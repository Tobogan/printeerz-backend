<?php

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
                'prenom' => 'Jérémy',
                'nom' => 'XS',
                'role' => 'admin',
                'email' => 'ruas.jeremy@gmail.com',
                'password' => 'adminadmin',
                'activate' => 1,
                'imageName' => null,
                'created_at' => '2018-09-08 11:19:17',
                'updated_at' => '2018-10-10 08:36:23',
            ),
        ));
    }
}