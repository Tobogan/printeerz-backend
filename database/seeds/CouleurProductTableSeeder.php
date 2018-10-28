<?php

use Illuminate\Database\Seeder;

class CouleurProductTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('couleur_product')->delete();
        
        \DB::table('couleur_product')->insert(array (
            0 => 
            array (
                'id' => 1,
                'product_id' => 1,
                'couleur_id' => 2,
            ),
            1 => 
            array (
                'id' => 2,
                'product_id' => 1,
                'couleur_id' => 3,
            ),
            2 => 
            array (
                'id' => 3,
                'product_id' => 1,
                'couleur_id' => 4,
            ),
            3 => 
            array (
                'id' => 10,
                'product_id' => 4,
                'couleur_id' => 1,
            ),
            4 => 
            array (
                'id' => 11,
                'product_id' => 4,
                'couleur_id' => 2,
            ),
            5 => 
            array (
                'id' => 12,
                'product_id' => 4,
                'couleur_id' => 3,
            ),
        ));
        
        
    }
}