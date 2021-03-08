<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class BlogPostController extends Controller
{
    /*
     * Index to list all blog posts on the same page - These are just published
     * Posts not ones that are un published.
     *
     * Libs: Carbon (Date/Time), Post Model,
     * return View object with Post array as parameter passed to view $published
     */
    public function index()
    {
        //Check that the blog post is in a published state that is
        // Post that has not got a published date in the future from now.
        $published = Post::with("user")
      ->where("published_at", "<", Carbon::now())
      ->orderBy("published_at", "desc")
      ->simplePaginate(15);

        return view("blog.index")->with("posts", $published);
    }

    public function View($slug)
    {
        $post = Post::with("user")
      ->where([["slug", "=", $slug], ["published_at", "<", Carbon::now()]])
      ->firstOrFail();
        // dd($post);
        return view("blog.view")->with("post", $post);
    }
}
