<?php

use Illuminate\Database\Seeder;

class TaillesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('tailles')->delete();
        
        \DB::table('tailles')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nom' => 'XS',
                'created_at' => '2018-09-08 11:19:17',
                'updated_at' => '2018-10-10 08:36:23',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'S',
                'created_at' => '2018-10-10 08:18:57',
                'updated_at' => '2018-10-10 08:18:57',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'M',
                'created_at' => '2018-10-10 10:01:14',
                'updated_at' => '2018-10-10 10:01:14',
            ),
            3 => 
            array (
                'id' => 4,
                'nom' => 'L',
                'created_at' => '2018-10-10 10:01:33',
                'updated_at' => '2018-10-10 10:01:33',
            ),
            4 => 
            array (
                'id' => 5,
                'nom' => 'XL',
                'created_at' => '2018-10-10 10:01:51',
                'updated_at' => '2018-10-10 10:01:51',
            ),
            5 => 
            array (
                'id' => 6,
                'nom' => 'XXL',
                'created_at' => '2018-10-10 10:02:04',
                'updated_at' => '2018-10-10 10:02:04',
            ),
        ));
        
    }
}