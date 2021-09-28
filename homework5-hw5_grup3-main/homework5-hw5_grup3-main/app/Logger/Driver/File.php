<?php

namespace App\Logger\Driver;

use App\Logger\LoggableInterface;

class File implements LogDriverInterface
{
    protected string $logFile;

    public function __construct(string $logFile)
    {
        $this->logFile = $logFile;
    }

    public function setLogFile(string $logFile): void
    {
        $this->logFile = $logFile;
    }

    public function setUp(): void
    {
        date_default_timezone_set('Europe/Istanbul');
    }

    public function log(string $message, string $level): void
    {
        $date = date("Y-m-d h:i:sa");
        if(!file_exists($this->logFile)){
            $data = LoggableInterface::INFO . " ". $date." ". "Log dosyası oluşturuldu" . PHP_EOL;
            file_put_contents($this->logFile, $data,FILE_APPEND);
        }
        $data = $level . " ". $date ." ".$message . PHP_EOL;
        file_put_contents($this->logFile, $data,FILE_APPEND);
    }

    public function tearDown(): void
    {
        $data = "Logdan çıkıldı." . PHP_EOL;
        file_put_contents($this->logFile, $data,FILE_APPEND);
    }
}