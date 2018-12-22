<?php

use Illuminate\Database\Seeder;

class EventVariantsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('event_variants')->delete();
        
        \DB::table('event_variants')->insert(array (

        ));
        
        
    }
}