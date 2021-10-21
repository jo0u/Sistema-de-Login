<?php
    define('HOST', 'localhost');
    define('USER', ''
    define('PASS','');
    define('DBNAME','');

    global $pdo;

    try {
        $pdo = new PDO('mysql:host='.HOST.';dbname='.DBNAME.';',USER,PASS);
        
    } catch (PDOException $e) {
        echo "ERRO".$e->getMessage();
        exit;
    }

   
    

?>