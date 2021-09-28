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

if (isset($_GET['post'])){
    $post = $_GET['post'];
    $book_id = $_GET['id'];

    try{
        $is_created = $db->create("posts",[["post"=>$post, "bookId" => $book_id]]);
    }catch (Exception $e){
        $logger->log($e, LoggableInterface::ERROR);
    }


}
?>
<?php include "_shared/header.php";?>
  <?php
if(isset($is_created)){

    echo "<p class='text-center alert-success'>Post başarıyla oluşturuldu</p>";
    echo "<br>";
    echo "<div class='d-flex justify-content-center'><a href='http://localhost/homework5-hw5_grup3/index.php' class='btn btn-primary mt-5'>Anasayfaya geri dön</a></div>";
}
    ?>
    <div class="container">
        <h1>Kitap İçin Post Oluştur</h1>
        <form action='post-create.php' method='GET'>
            <div class='form-group'>
                <div >

                    <input type="hidden" name="id" value='<?=$_GET['id']??'' ?>'>
                    <label for='post'>Post</label>
                    <textarea name="post" rows="10" cols="100" style="resize: none" class='form-control'></textarea>

                </div>
                <button class = 'btn btn-primary mt-3'>Gönder</button>
            </div>

        </form>
    </div>

<?php include "_shared/footer.php";?>