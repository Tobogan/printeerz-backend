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
                'photo_illustration' => NULL,
                'created_at' => '2018-10-21 18:11:48',
                'updated_at' => '2018-10-21 18:11:48',
            ),
            1 => 
            array (
                'id' => 2,
                'nom' => 'STANLEY LEADS ROUND NECK TEE-SHIRT',
                'reference' => 'ERDF457',
                'sexe' => 'Femme',
                'description' => NULL,
                'photo_illustration' => '1543765874.jpeg',
                'created_at' => '2018-12-02 15:51:14',
                'updated_at' => '2018-12-02 15:51:14',
            ),
        ));
        
        
    }
}