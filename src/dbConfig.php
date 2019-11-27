<?php

$host = 'mysql-server';
$dbname = 'iisdb';
$username = 'iisuser';
$password = 'iispwd';
$charset = 'utf8mb4';

$options = [
    PDO::ATTR_EMULATE_PREPARES      => false,                       # use real prepared statements (because SQL injection)
    PDO::ATTR_ERRMODE               => PDO::ERRMODE_EXCEPTION,      # throw exception instead error, for handling errors in queries
    PDO::ATTR_DEFAULT_FETCH_MODE    => PDO::FETCH_ASSOC,            # fetch return an array indexed by column name
];

$dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";

try{
    $pdo = new PDO($dsn, $username, $password, $options);
}catch(PDOException $e){
    error_log("Cannot connect database");
}