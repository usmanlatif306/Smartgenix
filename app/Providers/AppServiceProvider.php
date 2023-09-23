<?php

namespace App\Providers;

use App\Models\Page;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Builder;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Builder::macro('whereLike', function ($column, $search) {
            return $this->where($column, 'LIKE', "%{$search}%");
        });
        Builder::macro('OrWhereLike', function ($column, $search) {
            return $this->orWhere($column, 'LIKE', "%{$search}%");
        });

        view()->share('languages', [
            'en' => 'English',
            'fr' => 'French',
            'sp' => 'Spanish',
            'ar' => 'Arabic',
        ]);

        view()->share('pages', Page::whereIn('slug', ['privacy-policy', 'terms-conditions'])->get(['name', 'slug']));
    }
}
