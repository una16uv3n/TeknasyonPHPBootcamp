<?php
/**
 * post.php
 *
 * Bu betik direk olarak erişilebilir. functions.php'de yaptığınız gibi bir
 * kontrol eklemenize gerek yok.
 *
 * > Dikkat: Bu dosya hem direk çalıştırılabilir hem de `posts.php` dosyasında
 * > 1+ kez içe aktarılmış olabilir.
 *
 * Bu betik dosyası içerisinde functions.php'de yer alan fonksiyonları da kullanarak
 * aşağıdaki işlemleri gerçekleştirmenizi bekliyoruz.
 *
 * - $id değişkeni yoksa "1" değeri ile tanımlanmalı, daha önceden bu değişken
 * tanımlanmışsa değeri değiştirilmemeli. (Kontrol etmek için `isset`
 * (https://www.php.net/manual/en/function.isset.php) kullanılabilir.)
 * - $id için yapılan işlemin aynısı $title ve $type için de yapılmalı. (İstediğiniz
 * değerleri verebilirsiniz)
 * - Bir sonraki adımda ilgili içerik gösterilmeden önce bir div oluşturulmalı ve
 * bu div $type değerine göre arkaplan rengi almalıdır. (urgent=kırmızı,
 * warning=sarı, normal=arkaplan yok)
 * - `getPostDetails` fonksiyonu tetiklenerek ilgili içeriğin çıktısı gösterilmeli.
 */

// Validation true yapılarak functions.php dahil edilir.
$validation = true;
include_once 'functions.php';

    /* Yorum satırlarında olmama durumu için başlangıç değerleri verildi. isset değeri olması durumunda true dönüyor.Eğer değer varsa funstions.php de posts dizisi title ve type şeklinde oluşturulan dizi post.php de post olarak alınır ve değer atamaları yapılır.$color dizisi yukarıda belirtilen key,value değerlerine göre tanımlanmıştır. 
    */
    if(!isset($id)){ $id = 1;} else {$id = $key; }
    if(!isset($title)){ $title = "Title Yok"; } else { $title = $post['title']; }
    if(!isset($type)){ $type = "green"; } else { $type = $post['type']; }
    

    $color=["urgent"=>"red","warning"=>"yellow","normal"=>"null","green"=>"green"];

echo "<div style=background-color:". $color[$type] .">";
getPostDetails($id, $title); 
echo "</div>";

?>