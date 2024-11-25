<?php
try{
$db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
    "root",  "");
$query = $db ->prepare("SELECT * FROM fietsen");
$query->execute();
$result = $query->fetchAll(PDO::FETCH_ASSOC);
foreach ($result as $data) {
    echo "<a href='detail.php?id=" . $data['id'] . "'>";
    echo $data ['merk'] . " " . $data['type'];
    echo "</a>";
    echo "<br>";
   }
} catch (PDOException $e) {
    die ("Error!: " . $e->getMessage());
}
?>