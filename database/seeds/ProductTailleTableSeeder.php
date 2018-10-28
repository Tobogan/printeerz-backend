<?php

use Illuminate\Database\Seeder;

class ProductTailleTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_taille')->delete();
        
        \DB::table('product_taille')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'taille_id' => 1,
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 1,
                'taille_id' => 2,
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 1,
                'taille_id' => 3,
            ),
            3 => 
            array (
                'id' => 13,
                'product_id' => 4,
                'taille_id' => 1,
            ),
            4 => 
            array (
                'id' => 14,
                'product_id' => 4,
                'taille_id' => 2,
            ),
            5 => 
            array (
                'id' => 15,
                'product_id' => 4,
                'taille_id' => 3,
            ),
        ));
        
        
    }
}