<?php

require "vendor/autoload.php";

$config = require "config.php";

$engine = $config['engine'];
$host = $config['host'];
$user = $config['user'];
$pass = $config['password'];
$log_type = $config['logging'];
$log_file_dir = __DIR__."/storage/logs/logs.log";

use App\DB\Engine\Mysql;
use App\DB\Engine\MongoDB;
use App\Db\Database;
use App\Logger\Driver\Database as LoggerDatabase;
use App\Logger\Driver\File;
use App\Logger\Logger;
use App\Logger\LoggableInterface;


if ($engine == "mysql") {
    $driver = new Mysql($host, $user, $pass, "book_app");
} elseif ($engine =="mongodb") {
    $driver = new MongoDB("", "", "", "", "", []);
}
if($log_type =="file"){
    $logger = new Logger(new File($log_file_dir));
}else{
    $logger = new Logger(new LoggerDatabase($driver));
}
try{
    $db = new Database();
    $db->setDriver($driver);
}catch (Exception $e){
    $logger->log($e, LoggableInterface::ERROR);
}

    $id = $_GET['id'];

try{
    $is_deleted = $db->delete("book",$id);
}catch (Exception $e){
    $logger->log($e, LoggableInterface::ERROR);
}

?>

<?php include_once "_shared/header.php";?>
<?php
if($is_deleted){
        echo "<p class='text-center alert-success'>Kitap başarıyla silindi</p>";
        echo "<br>";
        echo "<div class='d-flex justify-content-center'><a href='http://localhost/homework5-hw5_grup3/index.php' class='btn btn-primary mt-5'>Anasayfaya geri dön</a></div>";
        header("Location:http://localhost/homework5-hw5_grup3/index.php");
}

?>
<?php include "_shared/footer.php";?>