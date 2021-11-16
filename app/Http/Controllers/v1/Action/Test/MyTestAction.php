<?php

namespace App\Http\Controllers\v1\Action\Test;

use App\Core\ModelValidationHandler;
use app\core\Prana;
use App\Exceptions\http\NotFoundHttpException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Http\Requests\StorePostRequest;
use App\Models\Test\Dto\TestDto;
use App\Services\tests\MyTestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Psr\Log\LoggerAwareTrait;

class MyTestAction extends Controller
{
    use ModelValidationHandler;
    use LoggerAwareTrait;

    /* @var $service MyTestService */
    public $service;

    public function __construct()
    {
        $this->service = App::make(MyTestService::class);
//        $this->setLogger(App::make(LoggerInterface::class));
    }

    /**
     * @param Request $req
     * @return array
     */
    public function run(Request $req): array
    {
        $dto = new TestDto($req->all());
        $dto->validate();
        $this->handleError($dto);

        try {
            $data = $this->service->retrieveSomeData($dto->getMigrationName());
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e->getCode());
        }

        return $data;
    }

    /**
     * @param StorePostRequest $req
     * @return array
     */
    public function run_(StorePostRequest $req): array
    {
        $req->validated();
        $migrationName = $req->get('migration_name');

        try {
            $data = $this->service->retrieveSomeData($migrationName);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e->getCode());
        }

        return $data;

    }
}
