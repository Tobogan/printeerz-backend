<?php

use Illuminate\Database\Seeder;

class ProductVariantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_variants')->delete();
        
        \DB::table('product_variants')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 2,
                'couleur_id' => 3,
                'taille_id' => 1,
                'qty' => NULL,
                'nom' => 'Black',
                'zone1' => 'Face Avant',
                'zone2' => NULL,
                'zone3' => NULL,
                'zone4' => NULL,
                'image1' => '15456604161.jpg',
                'image2' => NULL,
                'image3' => NULL,
                'image4' => NULL,
                'gabarit1' => '2',
                'gabarit2' => NULL,
                'gabarit3' => NULL,
                'gabarit4' => NULL,
                'created_at' => '2018-12-24 14:06:55',
                'updated_at' => '2018-12-24 14:06:56',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 2,
                'couleur_id' => 20,
                'taille_id' => 2,
                'qty' => NULL,
                'nom' => 'Bright Orange',
                'zone1' => 'Face Avant',
                'zone2' => NULL,
                'zone3' => NULL,
                'zone4' => NULL,
                'image1' => '15456604511.jpg',
                'image2' => NULL,
                'image3' => NULL,
                'image4' => NULL,
                'gabarit1' => '3',
                'gabarit2' => NULL,
                'gabarit3' => NULL,
                'gabarit4' => NULL,
                'created_at' => '2018-12-24 14:07:31',
                'updated_at' => '2018-12-24 14:07:31',
            ),
        ));
        
        
    }
}