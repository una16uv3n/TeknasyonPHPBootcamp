<?php

namespace App\Logger\Driver;

interface LogDriverInterface
{
    public function setUp():void;
    public function log(string $message, string $level):void;
    public function tearDown():void;
}