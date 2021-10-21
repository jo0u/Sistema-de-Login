<?php
session_start();
ob_start();
include_once 'conexao.php';

if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){
    header("Location: index.php");
}

?>
<h2><a href="logout.php">Sair</a></h2>