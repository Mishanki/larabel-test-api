<?php


declare(strict_types=1);


namespace App\Logging\Proccessor;

use Monolog\Processor\ProcessorInterface;

class TestProcessor implements ProcessorInterface
{
    public function __invoke(array $record): array
    {
        $record['processor_add_field'] = 'test';

        return $record;
    }
}
