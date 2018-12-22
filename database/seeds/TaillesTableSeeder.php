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
                'created_at' => '2018-12-19 13:16:24',
                'updated_at' => '2018-12-19 13:16:24',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'S',
                'created_at' => '2018-12-19 13:16:30',
                'updated_at' => '2018-12-19 13:16:30',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'M',
                'created_at' => '2018-12-19 13:16:35',
                'updated_at' => '2018-12-19 13:16:35',
            ),
        ));
        
        
    }
}