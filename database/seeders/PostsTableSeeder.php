<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Post;
use App\Models\User;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $admin = User::find(1);

        Post::truncate();

        $admin->pages()->saveMany([
      new Post([
        "title" => "Blog post example 1",
        "slug" => "blog-post-1",
        "excerpt" => "This is the body...",
        "body" => "This is the body of blog post 1",
      ]),
      new Post([
        "title" => "Blog post example 2",
        "slug" => "blog-post-2",
        "excerpt" => "This is the body...",
        "body" => "This is the body of blog post 2",
      ]),
      new Post([
        "title" => "Blog post example 3",
        "slug" => "blog-post-3",
        "excerpt" => "This is the body...",
        "body" => "This is the body of blog post 3",
      ]),
    ]);
    }
}
