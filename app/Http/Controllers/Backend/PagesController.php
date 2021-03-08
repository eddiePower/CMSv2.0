<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Page;
use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\WorkWithPage;

class PagesController extends Controller
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
        if (Auth::user()->isAdminOrEditor()) {
            //retrieve and store all page entries in db
            $pages = Page::defaultOrder()
        ->withDepth()
        ->simplePaginate(5);
        } else {
            $pages = Auth::user()
        ->pages()
        ->simplePaginate(5);
        }
        //now send those pages back under the var name "pages"
        return view("backend.pages.index", ["pages" => $pages]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view("backend.pages.create")->with([
      "model" => new Page(),
      "orderPages" => Page::defaultOrder()
        ->withDepth()
        ->get(),
    ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WorkWithPage $request)
    {
        $page = new Page($request->only(["title", "url", "content"]));
        //work with the values from edit and create pages
        Auth::user()
      ->pages()
      ->save($page);

        $this->UpdatePageOrder($page, $request);

        return redirect()
      ->route("pages.index")
      ->with("status", "The Page $request->title has been created");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function edit(Page $page)
    {
        if (Auth::user()->cant("update", $page)) {
            return redirect(route("pages.index"));
        }

        //pass in the page with the details for edit - model
        return view("backend.pages.edit", [
      "model" => $page,
      "orderPages" => Page::defaultOrder()
        ->withDepth()
        ->get(),
    ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function update(WorkWithPage $request, Page $page)
    {
        //
        if (Auth::user()->cant("update", $page)) {
            return redirect(route("pages.index"));
        }

        if ($response = $this->UpdatePageOrder($page, $request)) {
            return $response;
        }

        $page->fill($request->only(["title", "url", "content"]));
        $page->save();

        return redirect()
      ->route("pages.index")
      ->with("status", "The Page $request->title has been updated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Page  $page
     * @return \Illuminate\Http\Response
     */
    public function destroy(Page $page)
    {
        if (Auth::user()->cant("DELETE", $page)) {
            return redirect()
        ->route("pages.index")
        ->with("status", "Your do not have permission to delete.");
        }

        $page->delete();

        return redirect()
      ->route("pages.index")
      ->with("status", "The Page $page->title was deleted");
    }

    protected function UpdatePageOrder(Page $page, Request $request)
    {
        if ($request->has("order", "orderPage")) {
            if ($page->id == $request->orderPage) {
                return redirect()
          ->route("pages.edit", ["page", $page->id])
          ->withInput()
          ->withErrors([
            "error" =>
              "Ooops, you can not order a page against its self! Page A can not be a child of Page A etc...",
          ]);
            }

            $page->UpdatePageOrder($request->order, $request->orderPage);
        }
    }
}
