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
                'nom' => 'Black',
                'pantone' => '1539160561.png',
                'zone1' => 'Face Avant',
                'zone2' => 'Coeur',
                'zone3' => NULL,
                'zone4' => NULL,
                'zone5' => NULL,
                'image1' => '15437659621.jpg',
                'image2' => '15437659622.jpg',
                'image3' => NULL,
                'image4' => NULL,
                'image5' => NULL,
                'created_at' => '2018-12-02 15:52:42',
                'updated_at' => '2018-12-02 15:52:42',
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 2,
                'couleur_id' => 35,
                'nom' => 'Green',
                'pantone' => '1539166124.png',
                'zone1' => 'Face Avant',
                'zone2' => NULL,
                'zone3' => NULL,
                'zone4' => NULL,
                'zone5' => NULL,
                'image1' => '15437659771.jpg',
                'image2' => NULL,
                'image3' => NULL,
                'image4' => NULL,
                'image5' => NULL,
                'created_at' => '2018-12-02 15:52:57',
                'updated_at' => '2018-12-02 15:52:57',
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 2,
                'couleur_id' => 9,
                'nom' => 'Bright Red',
                'pantone' => '1539159537.png',
                'zone1' => 'Face Avant',
                'zone2' => NULL,
                'zone3' => NULL,
                'zone4' => NULL,
                'zone5' => NULL,
                'image1' => '15437659881.jpg',
                'image2' => NULL,
                'image3' => NULL,
                'image4' => NULL,
                'image5' => NULL,
                'created_at' => '2018-12-02 15:53:08',
                'updated_at' => '2018-12-02 15:53:08',
            ),
            3 => 
            array (
                'id' => 4,
                'product_id' => 3,
                'couleur_id' => 9,
                'nom' => 'Bright Red',
                'pantone' => '1539159537.png',
                'zone1' => 'Face Avant',
                'zone2' => NULL,
                'zone3' => NULL,
                'zone4' => NULL,
                'zone5' => NULL,
                'image1' => '15443805981.jpg',
                'image2' => NULL,
                'image3' => NULL,
                'image4' => NULL,
                'image5' => NULL,
                'created_at' => '2018-12-09 18:36:38',
                'updated_at' => '2018-12-09 18:36:38',
            ),
            4 => 
            array (
                'id' => 5,
                'product_id' => 4,
                'couleur_id' => 20,
                'nom' => 'Bright Orange',
                'pantone' => '1539165674.png',
                'zone1' => 'Face Avant',
                'zone2' => NULL,
                'zone3' => NULL,
                'zone4' => NULL,
                'zone5' => NULL,
                'image1' => '15443807271.jpg',
                'image2' => NULL,
                'image3' => NULL,
                'image4' => NULL,
                'image5' => NULL,
                'created_at' => '2018-12-09 18:38:47',
                'updated_at' => '2018-12-09 18:38:47',
            ),
        ));
        
        
    }
}