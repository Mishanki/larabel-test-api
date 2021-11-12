<?php

namespace App\Repositories\Test;

class TestRepository implements TestRepositoryInterface
{
    /**
     * @param int $id
     * @return int[]
     */
    public function retrieveOne(int $id): array
    {
        return ['some' => 1, 'static' => 2, 'mock' => 3];
    }
}
