<?php

namespace App\Repositories\Test;

interface TestRepositoryInterface
{
    public function retrieveOne(int $id): ?array;
}
