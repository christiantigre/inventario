<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Carbon\Carbon;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Carbon::setLocale('es');
        setlocale(LC_TIME, 'es_ES');
        Schema::defaultStringLength(191);
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() == 'local') {
        $this->app->register('Appzcoder\CrudGenerator\CrudGeneratorServiceProvider');
        $this->app->register('Hesto\MultiAuth\MultiAuthServiceProvider');
    }
    }
}
