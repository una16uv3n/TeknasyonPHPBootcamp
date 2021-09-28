<?php

namespace App\Logger;

use App\Logger\Driver\LogDriverInterface;

class Logger implements LoggableInterface
{

    protected LogDriverInterface $LogDriver;

    public function __construct(LogDriverInterface $LogDriver)
    {
        $this->LogDriver = $LogDriver;
    }

    public function setDriver(LogDriverInterface $LogDriver): void{
        $this->LogDriver = $LogDriver;
    }

    public function log(string $message, string $level): void
    {
        $this->LogDriver->setUp();
        $this->LogDriver->log($message, $level);
        $this->LogDriver->tearDown();

    }
}
