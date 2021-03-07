<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::find(1);

        Page::truncate();

        $admin->Pages()->saveMany([
      new Page([
        "title" => "About",
        "url" => "/about",
        "content" =>
          "<p>THis is the about this site page.. To be filled in later.</p>",
      ]),
      new Page([
        "title" => "Contact",
        "url" => "/contact",
        "content" =>
          "<p>Get in touch here at <a href='mailto:eddie.power@icloud.com'>eddie.power@icloud.com</a></p>",
      ]),
      new Page([
        "title" => "Another Page",
        "url" => "/anotherPage",
        "content" =>
          "<p>THis is another page to be filled in later. Placeholder 2021...</p>",
      ]),
    ]);
    }
}
