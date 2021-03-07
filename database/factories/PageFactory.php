<?php

namespace Database\Factories;

use App\Models\Page;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PageFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Page::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
      // new Page([
      // "title" => "About",
      // "url" => "/about",
      // "content" =>
      //   "<p>THis is the about this site page.. To be filled in later.</p>",
      // "user_id" => 1,
      // ]),
      // new Page([
      // "title" => "Contact",
      // "url" => "/contact",
      // "content" =>
      //   "<p>Get in touch here at <a href='mailto:eddie.power@icloud.com'>eddie.power@icloud.com</a></p>",
      // "user_id" => 1,
      // ]),
      // new Page([
      "title" => "Another Page",
      "url" => "/anotherPage",
      "content" =>
        "<p>THis is another page to be filled in later. Placeholder 2021...</p>",
      "user_id" => 1,
      // ]),
    ];
    }
}
