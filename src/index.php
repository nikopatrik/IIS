<?php
header('Content-type: text/html; charset=utf-8');

require_once 'dbConfig.php';

foreach ($pdo->query("SELECT * FROM restaurants") as $row){
    echo "Meno restaurace: ". $row['name'] . "</br>";
    echo "Adresa restaurace: ". $row['adresa'] . "</br>";
}
echo "Niko je najkrajsi v tejto miestnosti";
