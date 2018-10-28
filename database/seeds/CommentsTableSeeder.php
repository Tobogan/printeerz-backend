<?php

use Illuminate\Database\Seeder;

class CommentsTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('comments')->delete();
        
        \DB::table('comments')->insert(array (
            0 => 
            array (
                'id' => 1,
                'name' => 'Salut',
                'event_id' => '4',
                'user_id' => '1',
                'message' => 'Afin d’obtenir le look parfait, vous devez faire la coiffure appropriée. Coiffure de Pompadour est parmi l’absolu meilleur pour créer le look classique. Cette coupe de cheveux semble propre et fraîche et trouve la grande popularité parmi les coiffures de pompadour meilleurs et contemporain. Il n’est pas pour les paresseux. Ces coupes de cheveux semblent belles et sont faciles à garder. Avec un grand nombre de coiffures facilement disponibles, il est extrêmement difficile de s’installer sur la coupe de cheveux plus appropriée. Il y a un certain nombre de tendance coupe de cheveux qui ont l’air très chic et magnifique,',
                'created_at' => '2018-10-02 16:06:57',
                'updated_at' => '2018-10-02 16:06:57',
            ),
            1 => 
            array (
                'id' => 2,
                'name' => 'Commentaire',
                'event_id' => '3',
                'user_id' => '1',
                'message' => 'Afin d’obtenir le look parfait, vous devez faire la coiffure appropriée. Coiffure de Pompadour est parmi l’absolu meilleur pour créer le look classique. Cette coupe de cheveux semble propre et fraîche et trouve la grande popularité parmi les coiffures de pompadour meilleurs et contemporain. Il n’est pas pour les paresseux. Ces coupes de cheveux semblent belles et sont faciles à garder. Avec un grand nombre de coiffures facilement disponibles, il est extrêmement difficile de s’installer sur la coupe de cheveux plus appropriée. Il y a un certain nombre de tendance coupe de cheveux qui ont l’air très chic et magnifique,',
                'created_at' => '2018-10-02 16:09:05',
                'updated_at' => '2018-10-02 16:09:05',
            ),
            2 => 
            array (
                'id' => 3,
                'name' => 'ChloChette',
                'event_id' => '3',
                'user_id' => '1',
                'message' => 'Afin d’obtenir le look parfait, vous devez faire la coiffure appropriée. Coiffure de Pompadour est parmi l’absolu meilleur pour créer le look classique. Cette coupe de cheveux semble propre et fraîche et trouve la grande popularité parmi les coiffures de pompadour meilleurs et contemporain. Il n’est pas pour les paresseux. Ces coupes de cheveux semblent belles et sont faciles à garder. Avec un grand nombre de coiffures facilement disponibles, il est extrêmement difficile de s’installer sur la coupe de cheveux plus appropriée. Il y a un certain nombre de tendance coupe de cheveux qui ont l’air très chic et magnifique,',
                'created_at' => '2018-10-02 16:09:12',
                'updated_at' => '2018-10-02 16:09:12',
            ),
            3 => 
            array (
                'id' => 4,
                'name' => 'Chloé',
                'event_id' => '3',
                'user_id' => '1',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales.',
                'created_at' => '2018-10-02 16:11:07',
                'updated_at' => '2018-10-02 16:11:07',
            ),
            4 => 
            array (
                'id' => 5,
                'name' => 'Patoche',
                'event_id' => '3',
                'user_id' => '1',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales.',
                'created_at' => '2018-10-02 16:11:55',
                'updated_at' => '2018-10-02 16:11:55',
            ),
            5 => 
            array (
                'id' => 6,
                'name' => 'MoMan',
                'event_id' => '3',
                'user_id' => '1',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales.',
                'created_at' => '2018-10-02 16:12:42',
                'updated_at' => '2018-10-02 16:12:42',
            ),
            6 => 
            array (
                'id' => 7,
                'name' => 'admin',
                'event_id' => '3',
                'user_id' => '1',
                'message' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed non risus. Suspendisse lectus tortor, dignissim sit amet, adipiscing nec, ultricies sed, dolor. Cras elementum ultrices diam. Maecenas ligula massa, varius a, semper congue, euismod non, mi. Proin porttitor, orci nec nonummy molestie, enim est eleifend mi, non fermentum diam nisl sit amet erat. Duis semper. Duis arcu massa, scelerisque vitae, consequat in, pretium a, enim. Pellentesque congue. Ut in risus volutpat libero pharetra tempor. Cras vestibulum bibendum augue. Praesent egestas leo in pede. Praesent blandit odio eu enim. Pellentesque sed dui ut augue blandit sodales.',
                'created_at' => '2018-10-02 16:13:28',
                'updated_at' => '2018-10-02 16:13:28',
            ),
        ));
        
        
    }
}