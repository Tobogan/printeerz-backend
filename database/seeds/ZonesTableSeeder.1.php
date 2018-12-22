<?php

use Illuminate\Database\Seeder;

class ZonesTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('zones')->delete();
        
        \DB::table('zones')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nom' => 'Face arrière',
                'created_at' => '2018-09-08 11:17:48',
                'updated_at' => '2018-09-08 11:17:48',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'Face avant',
                'created_at' => '2018-09-08 11:17:50',
                'updated_at' => '2018-09-08 11:17:50',
            ),
            2 => 
            array (
                'id' => 3,
                'nom' => 'Coeur',
                'created_at' => '2018-09-08 11:17:52',
                'updated_at' => '2018-09-08 11:17:52',
            ),
        ));
        
        
    }
}