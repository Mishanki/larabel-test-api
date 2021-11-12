<?php

namespace App\Repositories\Test;

interface TestRepositoryInterface
{
    public function retrieveOne(string $migrationName): ?array;
}
