<?php

use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('products')->delete();
        
        \DB::table('products')->insert(array (
            0 => 
            array (
                'id' => 1,
                'nom' => 'Tshirt col V Homme',
                'reference' => 'ERDF457',
                'sexe' => 'Homme',
                'description' => NULL,
                'imageName' => NULL,
                'created_at' => '2018-10-21 18:11:48',
                'updated_at' => '2018-10-21 18:11:48',
            ),
        ));
        
        
    }
}