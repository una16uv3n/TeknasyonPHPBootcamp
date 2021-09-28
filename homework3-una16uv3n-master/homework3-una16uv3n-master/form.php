<?php

/**
 * UML diyagramında yer alan Form sınıfını oluşturmanız beklenmekte.
 * 
 * Sınıf içerisinde static olmayan `fields`, `action` ve `method`
 * özellikleri (property) olması gerekiyor.
 * 
 * Sınıf içerisinde static olan ve Form nesnesi döndüren `createPostForm`,
 * `createGetForm` ve `createForm` methodları bulunmalı. Bu metodlar isminde de
 * belirtilen metodlarda Form nesneleri oluşturmalı.
 * 
 * Sınıf içerisinde bir "private" başlatıcı (constructor) bulunmalı. Bu başlatıcı
 * içerisinden `action` ve `method` değerleri alınıp ilgili property'lere değerleri
 * aktarılmalıdır.
 * 
 * Sınıf içerisinde static "olmayan" aşağıdaki metodlar bulunmalıdır.
 *   - `addField` metodu `fields` property dizisine değer eklemelidir.
 *   - `setMethod` metodu `method` propertysinin değerini değiştirmelidir.
 *   - `render` metodu form'un ilgili alanlarını HTML çıktı olarak verip bir buton çıktıya eklemelidir.
 * 
 * Sonuç ekran görüntüsüne `result.png` dosyasından veya `result.html` dosyasından ulaşabilirsiniz.
 * `app.php` çalıştırıldığında `result.html` ile aynı çıktıyı verecek şekilde geliştirme yapmalısınız.
 * 
 * > **Not: İsteyenler `app2.php` ve `form2.php` isminde dosyalar oluşturup sınıfa farklı özellikler kazandırabilir.
 */



 class Form
 {  // Form classın propertylerinin private tanımlanması istenmişti.
    private string $action; 
    private string $method; 
    private array $fields; 

    //yapıcı method tanımlanarak, form propertlerine değerleri set edilir.
    private function construct($action,$method){

        $this->action = $action;
        $this->method = $method;
    }

    // erişim belirleyicisi sadece classdan üretilen sınıflarda method kullanılabilsin diye protected olarak yazıldı.
    protected static function createPostForm(string $action){ //app.php de belirtilen static createPostForm yapıldı.

        return new static($action,"POST"); 
    }
    protected static function createGetForm(string $action){ //app.php de belirtilen static createGetForm yapıldı.

        return new static($action,"GET"); 

    }
    protected static function createForm(string $action, string $method){ //app.php de belirtilen createForm, method değeri set edilebiliyor.

        return new static($action,$method); 

    }
    protected function render():void{ ?>

            // form tanımlaması yapılı form class a set edilen action ve method değerlerinin burada forma ataması yapılıyor.
       <form method='<?php echo $this->method ?>'; action='<?php echo $this->action ?>'>  
           // result.html de ki html taglerinin içine foreach döngüsü yardımıyla field de ki name ,label değerleri ggetirilir.
           <?php foreach ($this->fields as $field){ ?>

             <label for='<?php echo $field[1] ?>'><?php echo $field[0] ?></label> 

             <input type='text' name='<?php echo $field[1] ?>' value='<?php echo $field[2] ?>' />
             <?php } ?> 
             <button type="submit">Gönder</button> 
       </form> 
       <?php    }
       
    protected function addField(string $label, string $name, string $defaultValue="30"): void { // app.php de ki addFields methodunu tanımladık.
        $field = [$label,$name,$defaultValue]; 
       $this->fields[] = $field; // form class da tanımlanan field dizisine field değişkeni dizi elemanı olarak veriliyor.
    }
    protected function setMethod(string $method){ //Class da ki method property sine değer set ediyor.
        $this->method = $method; // method dan alınan değer form classın metoduna set edilerek methodu belirleyebiliyoruz.
    }
 }
 