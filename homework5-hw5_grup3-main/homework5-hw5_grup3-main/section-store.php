<?php include "_shared/header.php";?>

<?php

$state = $_GET['state'];

if ($state == 0){
    echo "Ekleme Başarısız oldu. Bölüm ekleme işlemini tekrar gerçekleştiriniz. Yönlendiriliyorsunuz...";

}else{

    echo "<p class='text-center alert-success'>Bölüm başarılı bir şekikde güncellendi</p>";
    echo "<br>";
    echo "<div class='d-flex justify-content-center'><a href='http://localhost/homework5-hw5_grup3/index.php' class='btn btn-primary mt-5'>Anasayfaya geri dön</a></div>";
}
header("Refresh:2;url=http://localhost/homework5-hw5_grup3/index.php");

?>

<?php include "_shared/footer.php";?>