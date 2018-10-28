<?php

use Illuminate\Database\Seeder;

class CouleursTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('couleurs')->delete();
        
        \DB::table('couleurs')->insert(array (
            0 => 
            array (
                'id' => 3,
                'pantoneName' => '1539160561.png',
                'nom' => 'Black',
                'created_at' => '2018-09-08 11:19:17',
                'updated_at' => '2018-10-10 08:36:23',
            ),
            1 => 
            array (
                'id' => 9,
                'pantoneName' => '1539159537.png',
                'nom' => 'Bright Red',
                'created_at' => '2018-10-10 08:18:57',
                'updated_at' => '2018-10-10 08:18:57',
            ),
            2 => 
            array (
                'id' => 20,
                'pantoneName' => '1539165674.png',
                'nom' => 'Bright Orange',
                'created_at' => '2018-10-10 10:01:14',
                'updated_at' => '2018-10-10 10:01:14',
            ),
            3 => 
            array (
                'id' => 21,
                'pantoneName' => '1539165693.png',
                'nom' => 'Hot Coral',
                'created_at' => '2018-10-10 10:01:33',
                'updated_at' => '2018-10-10 10:01:33',
            ),
            4 => 
            array (
                'id' => 22,
                'pantoneName' => '1539165711.png',
                'nom' => 'Red',
                'created_at' => '2018-10-10 10:01:51',
                'updated_at' => '2018-10-10 10:01:51',
            ),
            5 => 
            array (
                'id' => 23,
                'pantoneName' => '1539165724.png',
                'nom' => 'Burgundy',
                'created_at' => '2018-10-10 10:02:04',
                'updated_at' => '2018-10-10 10:02:04',
            ),
            6 => 
            array (
                'id' => 24,
                'pantoneName' => '1539165739.png',
                'nom' => 'Plum',
                'created_at' => '2018-10-10 10:02:19',
                'updated_at' => '2018-10-10 10:02:19',
            ),
            7 => 
            array (
                'id' => 25,
                'pantoneName' => '1539165752.png',
                'nom' => 'Azur',
                'created_at' => '2018-10-10 10:02:32',
                'updated_at' => '2018-10-10 10:02:32',
            ),
            8 => 
            array (
                'id' => 26,
                'pantoneName' => '1539165772.png',
                'nom' => 'Royal Blue',
                'created_at' => '2018-10-10 10:02:52',
                'updated_at' => '2018-10-10 10:02:52',
            ),
            9 => 
            array (
                'id' => 27,
                'pantoneName' => '1539165787.png',
                'nom' => 'Deep Royal Blue',
                'created_at' => '2018-10-10 10:03:07',
                'updated_at' => '2018-10-10 10:03:07',
            ),
            10 => 
            array (
                'id' => 28,
                'pantoneName' => '1539165801.png',
                'nom' => 'Navy',
                'created_at' => '2018-10-10 10:03:21',
                'updated_at' => '2018-10-10 10:03:21',
            ),
            11 => 
            array (
                'id' => 29,
                'pantoneName' => '1539165814.png',
                'nom' => 'Sky blue',
                'created_at' => '2018-10-10 10:03:34',
                'updated_at' => '2018-10-10 10:03:34',
            ),
            12 => 
            array (
                'id' => 30,
                'pantoneName' => '1539165856.png',
                'nom' => 'Baby Blue',
                'created_at' => '2018-10-10 10:04:16',
                'updated_at' => '2018-10-10 10:04:16',
            ),
            13 => 
            array (
                'id' => 31,
                'pantoneName' => '1539165878.png',
                'nom' => 'Citadel Blue',
                'created_at' => '2018-10-10 10:04:38',
                'updated_at' => '2018-10-10 10:04:38',
            ),
            14 => 
            array (
                'id' => 32,
                'pantoneName' => '1539165891.png',
                'nom' => 'Stargazer',
                'created_at' => '2018-10-10 10:04:51',
                'updated_at' => '2018-10-10 10:04:51',
            ),
            15 => 
            array (
                'id' => 33,
                'pantoneName' => '1539166016.png',
                'nom' => 'Golden Yellow',
                'created_at' => '2018-10-10 10:06:56',
                'updated_at' => '2018-10-10 10:06:56',
            ),
            16 => 
            array (
                'id' => 34,
                'pantoneName' => '1539166072.png',
                'nom' => 'Spectra Yellow',
                'created_at' => '2018-10-10 10:07:52',
                'updated_at' => '2018-10-10 10:07:52',
            ),
            17 => 
            array (
                'id' => 35,
                'pantoneName' => '1539166124.png',
                'nom' => 'Green',
                'created_at' => '2018-10-10 10:08:44',
                'updated_at' => '2018-10-10 10:08:44',
            ),
        ));
        
        
    }
}