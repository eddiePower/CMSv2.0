<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Get some Roles
        $adminRole = Role::where(["name", "Admin"])->first();
        $authorRole = Role::where((["name", "Author"])->first());

        User::truncate();

        $adminUser = User::create([
      "name" => "Admin",
      "email" => "eddie.power@icloud.com",
      "password" => bcrypt("password"),
    ]);

        $joe = User::create([
      "name" => "Joe",
      "email" => "joe@icloud.com",
      "password" => bcrypt("password"),
    ]);

        //add the user roles
        $adminUser->roles()->attach($adminRole);
        $joe->roles()->attach($authorRole);
    }
}
