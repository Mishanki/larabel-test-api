<?php

namespace App\Services\tests;

use App\Core\Errors;
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
     * @return array[]
     */
    public function retrieveSomeData(string $migrationName): array
    {
        if (!$data = $this->repository->retrieveOne($migrationName)) {
            throw new NotFoundException('Row is not found', Errors::NOT_FOUND_ERROR);
        }

        return $data;
    }
}
