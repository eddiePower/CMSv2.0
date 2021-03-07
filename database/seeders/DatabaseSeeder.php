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
        //\App\Models\User::factory(10)->create();
        // \App\Models\Role::factory(3)->create();
        \App\Models\Page::factory(1)->create();

        //     $this->call([
    //   RoleTableSeeder::class,
    //   UserTableSeeder::class,
    //   PagesTableSeeder::class,
    //   PostsTableSeeder::class,
    // ]);
    }
}
