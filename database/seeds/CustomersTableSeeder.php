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
                'denomination' => 'RedFabriq',
                'adresse' => '24 rue Hégésippe Moreau',
                'code_postal' => '75018',
                'ville' => 'PARIS',
                'siren' => '3165461361651',
                'activite' => 'Agence digitale',
                'event_id' => NULL,
                'nb_events' => 2,
                'nb_impression' => NULL,
                'contact_nom' => 'Ruas',
                'contact_prenom' => 'Jérémy',
                'contact_telephone' => '+33647529147',
                'contact_poste' => 'Responsable Event',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:51:08',
                'updated_at' => '2018-09-26 12:51:08',
            ),
            1 => 
            array (
                'id' => 2,
                'denomination' => 'Entreprise Test',
                'adresse' => '95 rue de la patouillerie, 44700 ORVAULT',
                'code_postal' => '44700',
                'ville' => 'ORVAULT',
                'siren' => '1549813211',
                'activite' => 'Agence digitale',
                'event_id' => NULL,
                'nb_events' => 2,
                'nb_impression' => NULL,
                'contact_nom' => 'Ruas',
                'contact_prenom' => 'Jérémy',
                'contact_telephone' => '0647529147',
                'contact_poste' => 'CEO',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:51:22',
                'updated_at' => '2018-09-26 12:51:22',
            ),
            2 => 
            array (
                'id' => 3,
                'denomination' => 'ENGIE',
                'adresse' => '11 rue Jean Moulin, 3ème étage',
                'code_postal' => '92400',
                'ville' => 'COURBEVOIE',
                'siren' => '3165461361651',
                'activite' => 'Elevage de cons',
                'event_id' => NULL,
                'nb_events' => 1,
                'nb_impression' => NULL,
                'contact_nom' => 'Choé',
                'contact_prenom' => 'Menut',
                'contact_telephone' => '0647529147',
                'contact_poste' => 'CEO',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:51:43',
                'updated_at' => '2018-09-26 12:51:43',
            ),
            3 => 
            array (
                'id' => 4,
                'denomination' => 'Mon Dos',
                'adresse' => '139 bd Saint denis',
                'code_postal' => '92400',
                'ville' => 'COURBEVOIE',
                'siren' => '1549813211',
                'activite' => 'Electrique de c moooort',
                'event_id' => NULL,
                'nb_events' => 8,
                'nb_impression' => NULL,
                'contact_nom' => 'JEREMY',
                'contact_prenom' => 'RUAS',
                'contact_telephone' => '0647529147',
                'contact_poste' => 'Responsable Event',
                'informations' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultri',
                'created_at' => '2018-09-26 12:52:09',
                'updated_at' => '2018-09-26 12:52:09',
            ),
        ));
        
        
    }
}