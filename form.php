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
class Form{ //Form sinifi 
    //Property tanimlama
    private array $fields=[];
    //Private construct olusturma
    //Otomatik olarak nesnenin propertysine yerlestirilir.(php8)
    private function __construct(
        private string $action,
        private string $method)//Turetilirken zorunlu olan degerler
    { }
    //Static olarak form nesnesi donduren(return) methodlar
    //Tekil olmasini istersek static kullaniriz.
    //Nesne uretmeye gerek kalmadan method ve ozellikler kullanilabilir.
    public static function createPostForm(string $action):Form{
        return new static($action,"POST");//static hangi class cagirdiysa onu temsil eder.
    }
    public static function createGetForm(string $action): Form{
        return new static($action,"GET");
    }
    //Form olusturan fonk.
    public static function createForm(string $action,string $method):Form{
        return new static($action,$method);
    }
    //Nonstatic Void Methodlar
    //fields property dizisine deger ekler.
    public function addField(string $label, string $name, ?string $defaultValue=null):void{
        $field["label"]=$label;
        $field["name"]=$name;
        $field["defaultValue"]=$defaultValue;
        array_push($this->fields, $field);
    }
    //method propertysinin degerini degistirir.
    public function setMethod(string $method):void{
        $this-> method=$method;
    }
    //formun ilgili alanlarini HTML cikti olarak verir.
    public function render():void{
        echo "<form action='".$this->action."' method='".$this->method."'>";
        foreach($this->fields as $field){
            echo "\t<label for='".$field["label"]."'>".$field["label"]."</label>";
            if(isset($field["defaultValue"])){
                echo "\t<input type='text' name='".$field["name"]."' value='".$field["defaultValue"]."'/>";
            }
            else{
                echo "\t<input type='text' name='".$field["name"]."'/>";
            }
        }
        echo "\t<button type='submit'>Gönder</button>";
        echo "</form>";
    }
}
