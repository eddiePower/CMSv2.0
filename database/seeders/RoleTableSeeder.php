<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //clear all roles
        Role::truncate();

        Role::create([
      "name" => "Admin",
      "description" => "The administration staff for this site.",
    ]);
        Role::create([
      "name" => "editor",
      "description" => "The editors of content on this site",
    ]);
        Role::create([
      "name" => "Author",
      "description" => "The authors of minor content on this site.",
    ]);
    }
}
