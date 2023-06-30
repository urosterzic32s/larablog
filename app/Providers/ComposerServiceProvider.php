<?php

namespace App\Providers;

use App\Models\Blog;
use Illuminate\Support\ServiceProvider;

class ComposerServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        view()->composer(['partials.meta_dynamic', 'layouts.nav'], function ($view) {
            $view->with('blogs', Blog::where('status', 1)->latest()->get());
        });


    }
}
