<?php

namespace App\Providers;

use App\Grpc\Controllers\AuthController;
use App\Grpc\Contracts\Validator;
use App\Grpc\LaravelValidator;
use Illuminate\Support\ServiceProvider;
use Protobuf\Identity\AuthServiceInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(Validator::class, LaravelValidator::class);
        $this->app->bind(AuthServiceInterface::class, AuthController::class);
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
