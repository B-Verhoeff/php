<?php
try {
    $db = new PDO("mysql:host=localhost;dbname=fietsenmaker",
        "root", "");
    if (isset ($_POST['verzenden'])) {
    $merk = filter_input(INPUT_POST, "merk", FILTER_SANITIZE_STRING);
    $type = filter_input(INPUT_POST, "type", FILTER_SANITIZE_STRING);
    $prijs = filter_input(INPUT_POST, "prijs", FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
    $query = $db->prepare()
    }
}
