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
                'created_at' => '2018-09-06 15:38:38',
                'updated_at' => '2018-09-06 15:38:38',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'M',
                'created_at' => '2018-09-06 15:39:03',
                'updated_at' => '2018-09-06 15:39:03',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'S',
                'created_at' => '2018-09-06 15:39:06',
                'updated_at' => '2018-09-06 15:39:06',
            ),
            3 => 
            array (
                'id' => 4,
                'nom' => 'L',
                'created_at' => '2018-09-06 15:39:12',
                'updated_at' => '2018-09-06 15:39:12',
            ),
            4 => 
            array (
                'id' => 5,
                'nom' => 'XL',
                'created_at' => '2018-09-06 15:39:16',
                'updated_at' => '2018-09-06 15:39:16',
            ),
            5 => 
            array (
                'id' => 6,
                'nom' => 'XXL',
                'created_at' => '2018-09-06 15:39:19',
                'updated_at' => '2018-09-06 15:39:19',
            ),
            6 => 
            array (
                'id' => 7,
                'nom' => 'XXXL',
                'created_at' => '2018-09-06 15:39:22',
                'updated_at' => '2018-09-06 15:39:22',
            ),
        ));
        
        
    }
}