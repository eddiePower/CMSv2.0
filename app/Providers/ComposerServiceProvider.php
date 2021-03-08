<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //call our composer to to add our pages to our tree or page hirarchy
        View::composer(["home.*", "blog.*"], function ($view) {
            $view->with("pages", \App\Models\Page::get()->toTree());
        });
    }
}
