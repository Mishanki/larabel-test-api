<?php

namespace App\Http\Controllers\v1\Action\Test;

use App\Exceptions\http\NotFoundHttpException;
use App\Exceptions\NotFoundException;
use App\Http\Controllers\Controller;
use App\Repositories\Test\TestRepository;
use App\Services\tests\MyTestService;

class MyTestAction extends Controller
{
    /* @var $service*/
    public $service;

    public function __construct()
    {
        $this->service = new MyTestService(new TestRepository());
    }

    /**
     * @return array
     */
    public function run(): array
    {
        $id = 1;

        try {
            $data = $this->service->retrieveSomeData($id);
        } catch (NotFoundException $e) {
            throw new NotFoundHttpException($e->getMessage(), $e->getCode());
        }

        return $data;
    }
}