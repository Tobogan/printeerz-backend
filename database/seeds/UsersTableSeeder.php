<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'firstname' => 'Jérémy',
                'lastname' => 'Ruas',
                'role' => 'admin',
                'email' => 'ruas.jeremy@gmail.com',
                'password' => '$2y$10$/xf6R6MY.L5eWprypeVcvORlw9w7fvpgm/.HJyyx2b6yQ/yMH9XIK',
                'activate' => 1,
                'imageName' => '1539182620.jpg',
                'remember_token' => 'aAO34YoZ1KKVZWUmeF7IbbYEAq4EyaST08gFEA2DsXKQwN3SQQkxVH1rZBQp',
                'created_at' => '2018-09-26 12:22:02',
                'updated_at' => '2018-10-10 14:43:40',
            ),
            1 => 
            array (
                'id' => 2,
                'firstname' => 'Julie',
                'lastname' => 'Morvan',
                'role' => 'admin',
                'email' => 'daniel.philippe@ifrance.com',
                'password' => '$2y$10$SvOBldszoLPcS5VubwDYae9zx5X4b05a6iE4IvMBobPfviBBUAkDy',
                'activate' => 1,
                'imageName' => '1539343282.jpg',
                'remember_token' => '4rFvYlUVZOvRpMx2JHwFCTope1tFTAMcxbJGlw8uXysqEQuqysWJW2vuk9uj',
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-12 11:21:22',
            ),
            2 => 
            array (
                'id' => 3,
                'firstname' => 'Madeleine',
                'lastname' => 'Marques',
                'role' => 'admin',
                'email' => 'igrenier@sfr.fr',
                'password' => '$2y$10$hDNa22tukPfFJgHeomPGYeR3s1aXXOmf.yERXcFSu7/igJ/ndvl32',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            3 => 
            array (
                'id' => 4,
                'firstname' => 'Nathalie',
                'lastname' => 'Carre',
                'role' => 'opérateur',
                'email' => 'xvincent@ifrance.com',
                'password' => '$2y$10$4wLmtGcrtfYSgZraD.MuEOAM7bpCjSr/hk8RY5vZnE32NHOPOZwf2',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            4 => 
            array (
                'id' => 5,
                'firstname' => 'Olivie',
                'lastname' => 'Allain',
                'role' => 'admin',
                'email' => 'emmanuel.royer@ruiz.fr',
                'password' => '$2y$10$BTQG.j8twVxtPg1tHKEr5eUKgifiL3PDizOqY.tBKoE2QBXo1G3xe',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            5 => 
            array (
                'id' => 6,
                'firstname' => 'Michelle',
                'lastname' => 'Marty',
                'role' => 'opérateur',
                'email' => 'franck.albert@dbmail.com',
                'password' => '$2y$10$vf75zaKhzhVe7NAa8Fy3yeKjTmlrrVgFho/xEc2ZKHIMS9echea4a',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            6 => 
            array (
                'id' => 7,
                'firstname' => 'Audrey',
                'lastname' => 'Parent',
                'role' => 'opérateur',
                'email' => 'aimee03@rodriguez.org',
                'password' => '$2y$10$Cz0zPL2KEDs3OKJbn/Zno.COblQpmhZN1sVyWpX7cV/kwVCCiDxz6',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            7 => 
            array (
                'id' => 8,
                'firstname' => 'Élodie',
                'lastname' => 'Guichard',
                'role' => 'opérateur',
                'email' => 'leclerc.eric@rousseau.fr',
                'password' => '$2y$10$hv7ZIaadhlX.SWPOFLHprOZsAMl9eIEOerub6.CCIb4fu9DUas1NO',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            8 => 
            array (
                'id' => 9,
                'firstname' => 'Zacharie',
                'lastname' => 'Seguin',
                'role' => 'opérateur',
                'email' => 'marc50@picard.org',
                'password' => '$2y$10$VZ/NghWJyej6mpbiM.2YVOIQj83gw2FoE/KlD8DU4qSI7SROivg7.',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            9 => 
            array (
                'id' => 10,
                'firstname' => 'Thibaut',
                'lastname' => 'Caron',
                'role' => 'opérateur',
                'email' => 'agnes05@leroux.org',
                'password' => '$2y$10$HA4nTIE4YNPC9URdKB74Guw7SwbE73A3agG94SyQClLsvLfVYPSG2',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:39',
                'updated_at' => '2018-10-10 13:25:39',
            ),
            10 => 
            array (
                'id' => 11,
                'firstname' => 'Aurore',
                'lastname' => 'Munoz',
                'role' => 'opérateur',
                'email' => 'klaporte@vincent.com',
                'password' => '$2y$10$ItM6HRvsCnjzrCO/3sQbleKiBDuiWQBZFTK2nb33hSs4j9osHlUia',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:40',
                'updated_at' => '2018-10-10 13:25:40',
            ),
            11 => 
            array (
                'id' => 12,
                'firstname' => 'Clémence',
                'lastname' => 'Wagner',
                'role' => 'technicien',
                'email' => 'xthierry@bonnin.org',
                'password' => '$2y$10$CzmJ7XXYLswyWGKqt3nj4.sAuReETnlaXM2XZhFDvr/IrZWeHwiMG',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:40',
                'updated_at' => '2018-10-10 13:25:40',
            ),
            12 => 
            array (
                'id' => 13,
                'firstname' => 'Corinne',
                'lastname' => 'David',
                'role' => 'technicien',
                'email' => 'augustin.legoff@wanadoo.fr',
                'password' => '$2y$10$YroU0qpB2EE6B1BeZJlBqeGGVTXdBQrVEKU3yUP3XDint9DaC4RvO',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:40',
                'updated_at' => '2018-10-10 13:25:40',
            ),
            13 => 
            array (
                'id' => 14,
                'firstname' => 'Marguerite',
                'lastname' => 'Leroy',
                'role' => 'technicien',
                'email' => 'augustin72@lucas.net',
                'password' => '$2y$10$OlhOKjvvJHYhLBWQnVleu.vBa3LDOs3FGk8lVeKz8lrE.5wwQfZo2',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:40',
                'updated_at' => '2018-10-10 13:25:40',
            ),
            14 => 
            array (
                'id' => 15,
                'firstname' => 'Dorothée',
                'lastname' => 'Blanchard',
                'role' => 'technicien',
                'email' => 'vaubry@tiscali.fr',
                'password' => '$2y$10$/4yYWhaUPTAcrPgdEhMTH.KjC8IGzbSQr1NGZdAmuvOL230jf0whK',
                'activate' => 1,
                'imageName' => NULL,
                'remember_token' => NULL,
                'created_at' => '2018-10-10 13:25:40',
                'updated_at' => '2018-10-10 13:25:40',
            ),
        ));
        
        
    }
}