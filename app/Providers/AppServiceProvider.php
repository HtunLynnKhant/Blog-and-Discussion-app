<?php

namespace App\Providers;
use App\Models\Category;
use App\Models\Language;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        View::share('category',Category::withCount('article')->get());
        View::share('language',Language::withCount('article')->get());
    }
}
