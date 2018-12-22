<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(TaillesTableSeeder::class);
        $this->call(ProductTailleTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CouleursTableSeeder::class);
        $this->call(ZonesTableSeeder::class);
        $this->call(ProductZoneTableSeeder::class);
        $this->call(CouleurProductTableSeeder::class);
        $this->call(EventsTableSeeder::class);
        $this->call(CustomersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(GabaritsTableSeeder::class);
        $this->call(ProductVariantsTableSeeder::class);
    }
}
