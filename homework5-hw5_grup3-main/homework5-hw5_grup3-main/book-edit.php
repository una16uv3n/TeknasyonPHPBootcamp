<?php
//autoload dahil edilir
require "vendor/autoload.php";

$config = require "config.php";
//DB çalıştırılır
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
//geti ile gelen id değeri yakalanır
if (isset($_GET['id'])){

    $bookId = $_GET['id'];
    $book = $db->find('book',$bookId);
    $authors = $db->all("author");

    foreach ($authors as $author){
        if ($bookId == $author['bookId']){
            $authorBookId = $author['bookId'];
            $auth['name'] = $author['author_name'];
            $authorId = $author['id'];
        }
    }

}

?>
<?php include "_shared/header.php";?>
<!--Edit işlemi için form bölümü -->
    <div class="container">
        <h1>Kitap Düzenleme Sayfası</h1>
        <form action='book-update.php'  method='GET'>
            <div class='form-group'>
                <div>
                    <input type='hidden' name='id' value='<?= $bookId??''; ?>'>
                    <input type="hidden" name='authorId' value='<?= $authorId??''; ?>'>
                    <label for='book'>Kitap</label>
                    <input type='text' name='book' class='form-control' value='<?= $book['name']??''; ?>'>
                    <label for='author'>Yazar</label>
                    <input type='text' name='author_name' class='form-control' value='<?= $auth['name']??''; ?>'>

                </div>
                <button class = 'btn btn-primary mt-3'>Gönder</button>
            </div>

        </form>
    </div>

<?php include "_shared/footer.php";?>
