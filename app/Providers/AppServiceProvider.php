<?php

namespace App\Providers;

use App\Repositories\Test\TestRepository;
use App\Repositories\Test\TestRepositoryInterface;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;
use PDO;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        /* @var $connection PDO */
        $connection = DB::connection()->getPdo();

        $this->app->bind(TestRepositoryInterface::class, function () use ($connection) {
            return new TestRepository($connection);
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
