<?php

use Illuminate\Database\Seeder;

class CustomersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('customers')->delete();
        
        \DB::table('customers')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'RedFabriq',
                'adress' => '24 rue Hégésippe Moreau',
                'postal_code' => '75018',
                'city' => 'PARIS',
                'siren' => '3165461361651',
                'activity' => 'Agence digitale',
                'event_id' => NULL,
                'event_qty' => 2,
                'print_qty' => NULL,
                'contact_lastname' => 'Ruas',
                'contact_firstname' => 'Jérémy',
                'contact_phone' => '+33647529147',
                'contact_job' => 'Responsable Event',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:51:08',
                'updated_at' => '2018-09-26 12:51:08',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Entreprise Test',
                'adress' => '95 rue de la patouillerie, 44700 ORVAULT',
                'postal_code' => '44700',
                'city' => 'ORVAULT',
                'siren' => '1549813211',
                'activity' => 'Agence digitale',
                'event_id' => NULL,
                'event_qty' => 2,
                'print_qty' => NULL,
                'contact_lastname' => 'Ruas',
                'contact_firstname' => 'Jérémy',
                'contact_phone' => '0647529147',
                'contact_job' => 'CEO',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:51:22',
                'updated_at' => '2018-09-26 12:51:22',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ENGIE',
                'adress' => '11 rue Jean Moulin, 3ème étage',
                'postal_code' => '92400',
                'city' => 'COURBEVOIE',
                'siren' => '3165461361651',
                'activity' => 'Elevage de cons',
                'event_id' => NULL,
                'event_qty' => 1,
                'print_qty' => NULL,
                'contact_lastname' => 'Choé',
                'contact_firstname' => 'Menut',
                'contact_phone' => '0647529147',
                'contact_job' => 'CEO',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:51:43',
                'updated_at' => '2018-09-26 12:51:43',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Mon Dos',
                'adress' => '139 bd Saint denis',
                'postal_code' => '92400',
                'city' => 'COURBEVOIE',
                'siren' => '1549813211',
                'activity' => 'Electrique de c moooort',
                'event_id' => NULL,
                'event_qty' => 8,
                'print_qty' => NULL,
                'contact_lastname' => 'JEREMY',
                'contact_firstname' => 'RUAS',
                'contact_phone' => '0647529147',
                'contact_job' => 'Responsable Event',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:52:09',
                'updated_at' => '2018-09-26 12:52:09',
            ),
        ));
        
        
    }
}