<?php

namespace App\Logger\Driver;

use App\DB\Engine\DriverInterface;

class Database implements LogDriverInterface
{
    protected DriverInterface $driver;

    public function __construct(DriverInterface $driver)
    {
        $this->driver = $driver;
    }
    public function setDriver(DriverInterface $driver):void{
        $this->driver = $driver;
    }

    public function setUp(): void
    {

    }

    public function log(string $message, string $level): void
    {
       $this->driver->create("log",[
           [
               "message" => $message,
               "level" => $level,
           ]
       ]);
    }

    public function tearDown(): void
    {
        // TODO: Implement tearDown() method.
    }
}