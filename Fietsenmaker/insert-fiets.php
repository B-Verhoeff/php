<?php
 try {
     $db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
         "root", "");
     $query = $db->prepare("INSERT INTO fietsen(merk, type, prijs) 
                      VALUES ('Giant', 'Travel Expedition', 999)");
     if($query->execute()) {
         echo "De niewe gegevens zijn toegevoegd.";
     } else {
         echo "Er is een fout opgetreden!";
     }
 } catch(PDOException $e) {
     die("Error!: " . $e->getMessage());
 }
 ?>