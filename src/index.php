<?php
header('Content-type: text/html; charset=utf-8');
$dsn = 'mysql:host=mysql-server;dbname=iisdb';
$username = 'iisuser';
$password = 'iispwd';
$options = array(
    PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8',
);

$pdo = new PDO($dsn, $username, $password, $options);

foreach ($pdo->query("SELECT * FROM restaurants") as $row){
    echo "Meno restaurace: ". $row['name'] . "</br>";
    echo "Adresa restaurace: ". $row['adresa'] . "</br>";
}
