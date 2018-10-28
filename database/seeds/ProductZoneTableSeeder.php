<?php

use Illuminate\Database\Seeder;

class ProductZoneTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('product_zone')->delete();
        
        \DB::table('product_zone')->insert(array (
            
        ));
        
        
    }
}