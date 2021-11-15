<?php

namespace App\Http\Controllers\v1\Action\Test;

use App\Exceptions\http\NotFoundHttpException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Services\tests\MyTestService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class MyTestAction extends Controller
{
    /* @var $service MyTestService */
    public $service;

    public function __construct()
    {
        $this->service = App::make(MyTestService::class);
    }

    /**
     * @param Request $req
     * @return array
     */
    public function run(Request $req): array
    {
        $name = (string) $req->get('migration_name');

        try {
            $data = $this->service->retrieveSomeData($name);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e->getCode());
        }

        return $data;
    }
}
