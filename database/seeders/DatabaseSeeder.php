<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Group all the specified seeder and migrate to database if run php artisan db:seed
        $this->call([
            UserTableSeeder::class,
        ]);
    }
}
