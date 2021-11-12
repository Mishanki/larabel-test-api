<?php

namespace App\Services\tests;

use App\Exceptions\NotFoundException;
use App\Repositories\Test\TestRepositoryInterface;

class MyTestService
{
    /* @var $repository TestRepositoryInterface */
    public $repository;
    /**
     * MyTestService constructor.
     * @param TestRepositoryInterface $repository
     */
    public function __construct(TestRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @return int[]
     */
    public function retrieveSomeData(int $id): array
    {
        if (!$data = $this->repository->retrieveOne($id)) {
            throw new NotFoundException('Data is not found', 101);
        }

        return $data;
    }
}
