<?php
//autoload çağırılır
require "vendor/autoload.php";

$config = require "config.php";
//DB başlatılıyor
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
//get ile gelen bir değer olup olmadığı kontrol ediliyor
if(isset($_GET['book']) || isset($_GET['author'])){
    $book = $_GET['book'];
    $author = $_GET['author'];
//create metodu çalışıyor
    try{
        $bookCreateState = $db->create("book",[["name" =>$book]]);
        $books = $db->all("book");
    }catch (Exception $e){
        $logger->log($e, LoggableInterface::ERROR);
    }
    $bookCounts = count($books);
    $lastbookId = $books[$bookCounts-1]['id'];

    try{
        $authorCreateState = $db->create("author", [["author_name" => $author,"bookID"=> $lastbookId]]);
    }catch (Exception $e){
        $logger->log($e, LoggableInterface::ERROR);
    }

    if ($bookCreateState && $authorCreateState){
        header("Location:http://localhost/homework5-hw5_grup3/book-store.php?state=1 ",true);

    }else{
        header("Location:http://localhost/homework5-hw5_grup3/book-store.php?state=0 ",true);

    }
}
?>
<?php include "_shared/header.php";?>
<!-- Kitap oluşturmak için form -->
<div class="container">
    <h1>Kitap Oluşturma Sayfası</h1>
    <form action='book-create.php' method='GET'>
        <div class='form-group'>
            <div >
                <label for='book'>Kitap</label>
                <input type='text' name='book' class='form-control' >
                <label for='author'>Yazar</label>
                <input type='text' name='author' class='form-control'  >
                <!-- <label for='desc'>Kitap Açıklama</label>
                 <textarea name="desc" rows="10" cols="100" style="resize: none" class='form-control'></textarea>-->
            </div>
            <button class = 'btn btn-primary mt-3'>Gönder</button>
        </div>

    </form>
</div>

<?php include "_shared/footer.php";?>
