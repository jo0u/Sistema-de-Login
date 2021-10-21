<?php
     session_start();
     ob_start();
    include_once( 'conexao.php');
   include 'header.php';

    if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){
        header("Location: index.php");
        
    }

   
   
  
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Visualizar</title>
</head>
<body>
    
    <center>
        <h1>Vizualizar</h1>
        <?php

$id = filter_input(INPUT_GET,"id_usuario",FILTER_SANITIZE_NUMBER_INT);
if(empty($id)){
    $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não encontrado !</p>";
    header("Location: listarFuncionario.php");
    exit();
   }
  
       
        
      $query_usuario = "SELECT id,nome,usuario,perfil,senha FROM funcionario WHERE id = $id ";
       $result_usuario = $pdo->prepare($query_usuario);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
           $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
           extract($row_usuario);
            
            echo "<br>ID: ".$id."<br>Nome: ".$nome."<br>Usuário: ".$usuario."<br>Perfil: ".$perfil."<br>Senha: ".$senha;
        }else{
            $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não encontrado !</p>";
            header("Location: listarFuncionario.php");
            exit();
        }


            
             
        ?>

    </center>


</body>
</html>