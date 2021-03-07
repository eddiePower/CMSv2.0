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

        $about = new Page([
      "title" => "About",
      "url" => "/about",
      "content" =>
        "<p>THis is the about this site page.. To be filled in later.</p>",
    ]);

        $faq = new Page([
      "title" => "FAQ",
      "url" => "/faq",
      "content" =>
        "<p>THis is the faq this site page.. To be filled in later.</p>",
    ]);

        $contact = new Page([
      "title" => "Contact",
      "url" => "/contact",
      "content" =>
        "<p>Get in touch here at <a href='mailto:eddie.power@icloud.com'>eddie.power@icloud.com</a></p>",
    ]);

        $another = new Page([
      "title" => "Another Page",
      "url" => "/anotherPage",
      "content" =>
        "<p>THis is another page to be filled in later. Placeholder 2021...</p>",
    ]);

        $admin->pages()->saveMany([$about, $faq, $contact, $another]);

        $about->appendNode($faq);
    }
}
