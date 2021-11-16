<?php

namespace App\Providers;

use app\helpers\monitoring\RequestCurrentTimePocessor;
use app\helpers\monitoring\RequestHttpMethodPocessor;
use app\helpers\monitoring\RequestIPProcessor;
use app\helpers\monitoring\RequestLoginProcessor;
use app\helpers\monitoring\RequestParamsPocessor;
use app\helpers\monitoring\RequestPasswordProcessor;
use app\helpers\monitoring\RequestURIProcessor;
use app\helpers\monitoring\RequestUserIdProcessor;
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
        /*
        $this->app->bind(LoggerInterface::class, function () {
            $rotationFileHandler = new RotatingFileHandler('/logs/system.log', 5, Logger::INFO);
            $rotationFileHandler->setFormatter(new JsonFormatter());
            $rotationFileHandler->setFilenameFormat('{date}/{filename}', 'Y/m/d');
            $handlers[] = $rotationFileHandler;

            $processors = [];
//            $processors[] = new RequestUserIdProcessor();

            return new Logger('main', $handlers, $processors);
        });
        */
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
