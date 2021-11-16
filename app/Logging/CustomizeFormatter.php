<?php

namespace App\Logging;

use App\Logging\Proccessor\TestProcessor;
use Illuminate\Log\Logger;
use Monolog\Formatter\JsonFormatter;
use Monolog\Handler\RotatingFileHandler;

class CustomizeFormatter
{
    /**
     * Настроить переданный экземпляр регистратора.
     *
     * @param  Logger  $logger
     * @return void
     */
    public function __invoke(Logger $logger)
    {
        foreach ($logger->getHandlers() as $handler) {
            /* @var $handler RotatingFileHandler */
            $handler->setFormatter(new JsonFormatter());
            $handler->setFilenameFormat('{date}/{filename}', 'Y/m/d');
            $handler->pushProcessor(new TestProcessor());
        }
    }
}
