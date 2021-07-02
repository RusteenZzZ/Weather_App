<?php
// Put your data here ---
$host = '';
$db_name = '';
$login = '';
$password = '';
// ----------------------

$dsn = `mysql:host=${host};dbname=${db_name}`;
try{
    $pdo = new PDO($dsn, $login, $password);
}catch(PDOException $e){
    die("./include/connect.php error");
}

?>