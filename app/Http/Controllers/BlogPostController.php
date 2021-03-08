<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Carbon\Carbon;

class BlogPostController extends Controller
{
    //
    public function index()
    {
        $published = Post::with("user")
      ->where("published_at", "<", Carbon::now())
      ->orderBy("published_at", "desc")
      ->simplePaginate(15);

        return view("blog.index")->with("posts", $published);
    }
}
