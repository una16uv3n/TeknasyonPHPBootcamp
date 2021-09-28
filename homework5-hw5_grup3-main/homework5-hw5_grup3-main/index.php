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

try{
    $books = $db->all("book");
    $authors = $db->all("author");
}catch (Exception $e){
    $logger->log($e, LoggableInterface::ERROR);
}

?>

<?php  include "_shared/header.php";?>
<div class="container">
    <div class="d-flex justify-content-end">
        <div>
            <a href="book-create.php" class="btn btn-primary">Kitap Ekle</a>
        </div>
    </div>
    <hr>
    <!-- Books -->
    <div class="row" style="justify-content: center">
        <?php
            foreach ($books as $book){
                if (($book['image'] == "")){
                    $book['image'] = "resources/images/default.jpg";
                }
                $book_desc = substr($book['desc'],0, 100);
                echo " 
<!-- Book -->
         <div class='col-3 m-2'>
            <div class='card imgcard'>
                <a href='book.php?id=$book[id]'><img class='card-img-top' src='http://localhost/homework5-hw5_grup3/$book[image]' alt='Card image cap'></a>
                <div class='card-body'>
                    <h5 class='card-title'>$book[name]</h5>
                    <small style='font-size:14px; color: brown'>";
                foreach ($authors as $author){
                    if ($book['id'] == $author['bookId']){
                        echo $author['author_name'];
                    }
                }
                    echo "</small>
                    <p class='card-text'>$book_desc</p>
                    <a href='book-edit.php?id=$book[id]' class='btn btn-warning btn-attr'>Düzenle</a>
                <a href='book-delete.php?id=$book[id]' class='btn btn-danger btn-attr'>Sil</a>
                </div>
            </div>
        </div>
  <!-- Book -->
        ";
            }
        ?>
    </div>
    <!-- Books -->
    <hr>
</div>


<?php include "_shared/footer.php";?>

