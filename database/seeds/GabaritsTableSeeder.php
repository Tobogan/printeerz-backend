<?php

use Illuminate\Database\Seeder;

class GabaritsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('gabarits')->delete();
        
        \DB::table('gabarits')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nom' => 'Gabarit1',
                'created_at' => '2018-10-10 14:12:37',
                'updated_at' => '2018-10-10 14:12:37',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'Gabarit2',
                'created_at' => '2018-10-10 14:12:40',
                'updated_at' => '2018-10-10 14:12:40',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'Gabarit3',
                'created_at' => '2018-10-10 14:12:45',
                'updated_at' => '2018-10-10 14:12:45',
            ),
            3 => 
            array (
                'id' => 4,
                'nom' => 'Gabarit4',
                'created_at' => '2018-10-10 14:12:49',
                'updated_at' => '2018-10-10 14:12:49',
            ),
            4 => 
            array (
                'id' => 5,
                'nom' => 'Gabarit5',
                'created_at' => '2018-10-10 14:12:53',
                'updated_at' => '2018-10-10 14:12:53',
            ),
        ));
        
        
    }
}