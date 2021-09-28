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

if (isset($_GET['id'])){
    $bookID = $_GET['id'];
}

if(isset($_GET['section_name'])){
    $section_name = $_GET['section_name'];
    $bookID = $_GET['bookID'];
    $content = $_GET['content'];

    try {
        $section_create = $db->create("section",[["section_name"=>$section_name, "content"=>$content, "bookId"=>$bookID]]);
    }catch (Exception $e){
        $logger->log($e,LoggableInterface::ERROR);
    }

    if($section_create){
        header("Location:http://localhost/homework5-hw5_grup3/section-store.php?state=1");
    } else {
    header("Location:http://localhost/homework5-hw5_grup3/section-store.php?state=0 ");
}

}
?>

<?php include "_shared/header.php";?>

    <div class="container">
        <h1>Bölüm Oluşturma Sayfası</h1>
        <form action='section-create.php' method='GET'>
            <div class='form-group'>
                <div >
                    <label for='section_name'>Bölüm İsmi</label>
                    <input type='text' name='section_name' class='form-control' >
                    <label for='content'>Bölüme Özel İçerik</label>
                    <input type='text' name='content' class='form-control'  >
                    <input type='hidden' name='bookID' class='form-control'  value="<?=$bookID??''?>">
                </div>
                <button class = 'btn btn-primary mt-3'>Gönder</button>
            </div>

        </form>
    </div>

<?php include "_shared/footer.php";?>