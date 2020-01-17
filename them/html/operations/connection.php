<?php
try {
    $db = new PDO('mysql:host=localhost;dbname=registration','root', 'cemaytan');
     //echo "VERITABANINA BAGLANTI BASARILI";      
} catch (PDOException $e) {
    print "Hata!: " . $e->getMessage() . "<br/>";
}
?>	