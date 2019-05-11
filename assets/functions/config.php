<?php

try{
    $pdo = new PDO("mysql:dbname=gustavow_enquete;host=localhost", "root", "");
}catch(PDOExeption $e){
    echo 'ERRO:'.$e->getMessage();
    exit;
}
?>
