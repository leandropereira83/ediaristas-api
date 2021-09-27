<?php

namespace App\Providers;

use App\Services\ConsultaCEP\ConsultaCEPInterface;
use App\Services\ConsultaCEP\Providers\ViaCEP;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(ConsultaCEPInterface::class, function($app){
            return new ViaCEP;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
