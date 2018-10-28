<?php

use Illuminate\Database\Seeder;

class EventsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('events')->delete();
        
        \DB::table('events')->insert(array (
            0 => 
            array (
                'id' => 5,
                'nom' => 'E3',
                'customer_id' => 1,
                'annonceur' => 'GotagaCorp',
                'logoName' => '1539183214.png',
                'BAT_name' => NULL,
                'lieu' => 'Paris 12',
                'date' => '2018-10-10 00:00:00',
                'type' => 'Salon du jeux vidéos',
                'description' => 'L’Electronic Entertainment Expo, plus connu sous le nom de E3 ou E³, est l\'un des plus grands salons international du jeu vidéo et des loisirs interactifs. Il se déroule aux États-Unis.',
                'created_at' => '2018-10-10 14:53:33',
                'updated_at' => '2018-10-10 14:53:34',
            ),
            1 => 
            array (
                'id' => 6,
                'nom' => 'Blizzcon',
                'customer_id' => 3,
                'annonceur' => 'BlizzardCorp',
                'logoName' => '1539183319.jpg',
                'BAT_name' => NULL,
                'lieu' => 'LA maggle',
                'date' => '2020-12-14 00:00:00',
                'type' => 'Conférence',
                'description' => 'La BlizzCon est un événement organisé presque chaque année depuis 2005 par la société Blizzard Entertainment. Cette convention est organisée au Anaheim Convention Center de Anaheim en Californie, pour rencontrer les joueurs, proposer des démos jouables de ses jeux à paraître, et proposer divers autres activités et panels liés aux univers de Warcraf',
                'created_at' => '2018-10-10 14:55:18',
                'updated_at' => '2018-10-10 14:55:19',
            ),
            2 => 
            array (
                'id' => 7,
                'nom' => 'BlendWebMix',
                'customer_id' => 4,
                'annonceur' => 'Guillaume Bertholet',
                'logoName' => '1539183410.jpg',
                'BAT_name' => NULL,
                'lieu' => 'Lyon',
                'date' => '2019-11-10 00:00:00',
                'type' => 'Festival',
                'description' => 'BlendWebMix ce sont des conférences mais pas QUE ! Animations, networking, temps calmes, tout est pensé pour passer un bon moment.
Pour te faire profiter et t’amuser pendant ces 2 jours, nous avons prévu des animations, des temps calmes et des ateliers web et sociétaux dans le Village. Stay tuned, bientôt le programme !',
                'created_at' => '2018-10-10 14:56:49',
                'updated_at' => '2018-10-10 14:56:50',
            ),
            3 => 
            array (
                'id' => 8,
                'nom' => 'ParisGamesWeek',
                'customer_id' => 4,
                'annonceur' => 'Domingo',
                'logoName' => '1539183467.png',
                'BAT_name' => NULL,
                'lieu' => 'Paris',
                'date' => '2018-10-10 00:00:00',
                'type' => 'Salon',
                'description' => 'La Paris Games Week est un salon annuel dédié aux jeux vidéo, créé en 2008, dont la première édition s\'est déroulée du 27 au 31 octobre 2010 et est organisé par le Syndicat des éditeurs de logiciels de loisirs.',
                'created_at' => '2018-10-10 14:57:46',
                'updated_at' => '2018-10-10 14:57:47',
            ),
            4 => 
            array (
                'id' => 9,
                'nom' => 'Solidays',
                'customer_id' => 2,
                'annonceur' => 'Mairie de Paris',
                'logoName' => '1539189145.png',
                'BAT_name' => NULL,
                'lieu' => 'Boulogne Billancourt',
                'date' => '2019-02-15 00:00:00',
                'type' => 'Festival',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet',
                'created_at' => '2018-10-10 16:32:24',
                'updated_at' => '2018-10-10 16:32:25',
            ),
            5 => 
            array (
                'id' => 10,
                'nom' => 'Mondial de l\'Auto',
                'customer_id' => 1,
                'annonceur' => 'Bernard de la Villardière',
                'logoName' => '1539189197.jpg',
                'BAT_name' => NULL,
                'lieu' => 'COURBEVOIE',
                'date' => '2019-10-10 00:00:00',
                'type' => 'Salon',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet',
                'created_at' => '2018-10-10 16:33:17',
                'updated_at' => '2018-10-10 16:33:17',
            ),
            6 => 
            array (
                'id' => 11,
                'nom' => 'Salon de l\'immobilier',
                'customer_id' => NULL,
                'annonceur' => 'Vinci',
                'logoName' => '1539189300.jpg',
                'BAT_name' => NULL,
                'lieu' => 'ORVAULT',
                'date' => '2018-10-10 00:00:00',
                'type' => 'Salon',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet',
                'created_at' => '2018-10-10 16:35:00',
                'updated_at' => '2018-10-10 16:35:00',
            ),
            7 => 
            array (
                'id' => 12,
                'nom' => 'Hellfest',
                'customer_id' => 1,
                'annonceur' => 'Christine Boutin',
                'logoName' => '1539189337.png',
                'BAT_name' => NULL,
                'lieu' => 'Clisson',
                'date' => '2018-10-10 00:00:00',
                'type' => 'Festival',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet',
                'created_at' => '2018-10-10 16:35:36',
                'updated_at' => '2018-10-10 16:35:37',
            ),
            8 => 
            array (
                'id' => 13,
                'nom' => 'Web2day',
                'customer_id' => 2,
                'annonceur' => 'La Cantine du Numérique',
                'logoName' => '1539189554.png',
                'BAT_name' => NULL,
                'lieu' => 'Nantes',
                'date' => '2019-11-10 00:00:00',
                'type' => 'Conférence',
                'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet',
                'created_at' => '2018-10-10 16:39:13',
                'updated_at' => '2018-10-10 16:39:14',
            ),
            9 => 
            array (
                'id' => 17,
                'nom' => 'SummerParty',
                'customer_id' => 2,
                'annonceur' => 'Paris étudiant',
                'logoName' => '1539252029.jpg',
                'BAT_name' => '1539252029.pdf',
                'lieu' => 'Paris',
                'date' => '2018-10-11 00:00:00',
                'type' => 'Festival',
                'description' => 'Le faux-texte est, en imprimerie, un texte sans signification, dont le seul objectif est de calibrer le contenu d\'une page par du texte, fût-il non éditorial, pour travailler sur la seule mise en forme de la page. Le texte définitif prendra la place du faux-texte, une fois que la mise en forme sera jugée acceptable',
                'created_at' => '2018-10-11 10:00:29',
                'updated_at' => '2018-10-11 10:00:29',
            ),
        ));
        
        
    }
}