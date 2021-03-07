<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Auth;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBlogRequest;
use App\Http\Requests\UpdateBlogRequest;

class BlogController extends Controller
{
  public function __construct()
  {
    $this->middleware("Admin");
  }

  /**
   * Display a listing of the resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function index()
  {
    //
    if (Auth::user()->isAdminOrEditor()) {
      //retrieve and store all page entries in db
      $posts = Post::simplePaginate(5);
    } else {
      $posts = Auth::user()
        ->posts()
        ->simplePaginate(5);
    }
    //now send those pages back under the var name "pages"
    return view("backend.blog.index", ["model" => $posts]);
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    //
    return view("backend.blog.create")->with("model", new Post());
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(StoreBlogRequest $request)
  {
    //
    Auth::user()
      ->posts()
      ->save(
        new Post(
          $request->only(["title", "excerpt", "slug", "published_at", "body"])
        )
      );
    dd($request);
    return redirect()
      ->route("blog.index")
      ->with("status", "The Post $request->title has been created");
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function edit(Post $blog)
  {
    // if (Auth::user()->cant("update", $blog)) {
    //     return redirect(route("blog.index"));
    // }
    //pass in the page with the details for edit - model
    return view("backend.blog.edit")->with("model", $blog);
  }

  /**
   * Update the specified resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateBlogRequest $request, Post $blog)
  {
    if (Auth::user()->cant("update", $blog)) {
      return redirect()
        ->route("blog.index")
        ->with("status", "Your do not have permission to edit.");
    }

    $blog
      ->fill(
        $request->only(["title", "excerpt", "slug", "published_at", "body"])
      )
      ->save();
    return redirect()
      ->route("blog.index")
      ->with("status", "The Blog Post $blog->title has been updated");
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Models\Post  $post
   * @return \Illuminate\Http\Response
   */

  public function destroy(Post $blog)
  {
    if (Auth::user()->cant("delete", $blog)) {
      return redirect()
        ->route("blog.index")
        ->with("status", "You do not have permission to delete.");
    }

    $blog->delete();

    return redirect()
      ->route("blog.index")
      ->with("status", "The Blog Post $blog->title was deleted");
  }
}
