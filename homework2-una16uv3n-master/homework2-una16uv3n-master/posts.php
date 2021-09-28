<?php

/**
 * posts.php
 *
 * Bu betik direk olarak erişilebilir. functions.php'de yaptığınız gibi bir
 * kontrol eklemenize gerek yok.
 *
 * Bu betik dosyası içerisinde functions.php'de yer alan fonksiyonları da kullanarak
 * aşağıdaki işlemleri gerçekleştirmenizi bekliyoruz.
 *
 * - functions.php içerisinde oluşturacağınız `getRandomPostCount` fonksiyonunuza min
 * ve max değerleri gönderip bu fonksiyondan rastgele bir tam sayı elde etmeniz
 * gerekiyor. (min ve max için istediğiniz değerleri seçebilirsiniz. Random bir
 * tam sayı elde etmek için `rand` (https://www.php.net/manual/en/function.rand.php)
 * fonksiyonunu kullanabilirsiniz.)
 *
 * - Elde ettiğiniz bu sayıyı da kullanarak `getLatestPosts` fonksiyonunu
 * çalıştırmalısınız. Bu fonksiyondan aldığınız diziyi kullanarak `post.php` betik
 * dosyasını döngü içinde dahil etmeli ve her yazı için detayları göstermelisiniz.
 */

// Validation true yapılarak functions.php dahil edilir.
$validation = true;
include 'functions.php';

$randomCount = getRandomPostCount(1,100);

/* Yukarıda oluşturulan random sayı  functions.php de geyLatesPost da ön tanımlı olarak gelen değişkenin yerine atanır ve döngünün sayısı belirleyerek oluştulan postlar foreach yapısında include edilen post.php de tanımladığımız div her bir eleman için posts.php de yazdırılır. */
$posts = getLatestPosts($randomCount);

foreach ($posts as $key => $post) {
    include 'post.php';
}