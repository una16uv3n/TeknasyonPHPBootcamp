<?php
require "vendor/autoload.php";

if (isset($_GET['id'])){
    $section_id = $_GET['id'];
}

?>

<?php include "_shared/header.php";?>

<div class="container">
    <h1>Bölüm Düzenleme Sayfası</h1>
    <form action='section-update.php' method='GET'>
        <div class='form-group'>
            <div >
                <label for='section_name'>Bölüm İsmi</label>
                <input type='text' name='section_name' class='form-control' >
                <label for='content'>Bölüme Özel İçerik</label>
                <input type='text' name='content' class='form-control'  >
                <input type='hidden' name='id' class='form-control'  value="<?=$section_id??''?>">
            </div>
            <button class = 'btn btn-primary mt-3'>Gönder</button>
        </div>

    </form>
</div>

<?php include "_shared/footer.php";?>
