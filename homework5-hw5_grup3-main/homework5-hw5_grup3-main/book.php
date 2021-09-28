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

    try {
        $book = $db->find("book",$_GET['id']);
        $authors = $db->all("author");
        $sections = $db->all("section");
        $posts = $db->all("posts");

    }catch (Exception $e){
        $logger->log($e, LoggableInterface::ERROR);
    }

    foreach ($authors as $author){
        if ($book['id'] == $author['bookId']){
            $author_name =$author['author_name'];

        }
    }

    foreach ($sections as $section){
        if($book['id'] == $section['bookId']){
            $content_list[] = $section['content'];
            $sectionID = $section['id'];
            $section_operations_arr[] = [
                $section['id'] => $section['section_name']
            ];
        }
    }
}

?>

<?php include "_shared/header.php";?>

<div class="container">
    <div class="d-flex justify-content-end">
        <div>
            <a href="section-create.php?id=<?=$_GET['id']?>" class="btn btn-primary mr-3">Bölüm Ekle</a>
        </div>
        <div>
            <a href="post-create.php?id=<?=$_GET['id']?>" class="btn btn-primary">Yazı Ekle</a>
        </div>
    </div>
    <hr>

    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Bölüm id</th>
            <th scope="col">Kitap</th>
            <th>Yazar</th>
            <th>Bölüm</th>
            <th scope="col">Düzenle&Sil</th>

        </tr>
        </thead>
        <tbody>

    <?php
    if (isset($_GET['id'] ) && isset($section_operations_arr)){
        foreach ($section_operations_arr as $section) {
            foreach ($section as $section_id => $section_name){

                echo " 
        <tr>
            <th scope='row'>$section_id</th>
            <td>$book[name]</td>
            <td>$author_name</td>
            <td>$section_name</td>
            <td>
                <div class=''>
                    <a href='section-edit.php?id=$section_id' class='btn btn-warning mr-3 '>Bölüm Düzenle</a> 
                    <a href='section-delete.php?id=$section_id' class='btn btn-danger '>Bölümü Sil</a>
                </div>    
            </td>  
        </tr>";
            }
        }
    }


    ?>
        </tbody>
    </table>
    <div class="mt-5">
        <h1 class="text-center"><?= $book['name']??''?></h1>
        <h3 class="text-center mt-3"><?= $author_name??'' ?></h3>
    </div>

    <div class="mt-5">
        <?php
        foreach ($posts as $post){
            if($book['id'] == $post['bookId']){
            echo "<div class='mt-5'><p>$post[post]</p></div>
                <div class='mt-3'>
                    <a href='post-edit.php?id=$post[id]' class='btn btn-warning mr-3 '>Post Düzenle</a> 
                    <a href='post-delete.php?id=$post[id]' class='btn btn-danger '>Post Sil</a>
                </div> ";
        }
        }
        ?>
    </div>

</div>

<?php include "_shared/footer.php";?>