<?php include "_shared/header.php";?>
<div class="container">

<?php

    $state = $_GET['state'];

    if ($state == 0){
        echo "Ekleme Başarısız oldu. Kitap ekleme işlemini tekrar gerçekleştiriniz. Yönlendiriliyorsunuz...";

    }else{
        echo "<p class='text-center alert-success'>Kitap başarıyla Eklendi</p>";
        echo "<br>";
        echo "<div class='d-flex justify-content-center'><a href='http://localhost/homework5-hw5_grup3/index.php' class='btn btn-primary mt-5'>Anasayfaya geri dön</a></div>";
    }

?>
</div>
<?php include "_shared/footer.php";?>