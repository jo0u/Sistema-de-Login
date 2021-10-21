<?php
    
    session_start();
    include "conexao.php";


   $SendEditSenha = filter_input(INPUT_POST,'SendEditSenha',FILTER_SANITIZE_STRING);

   if($SendEditSenha){
       //recebendo dados
       $id =addslashes(filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));
    $nome =addslashes(filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING)) ;
    $perfil =addslashes(filter_input(INPUT_POST,'perfil',FILTER_SANITIZE_STRING)) ;
    $usuario =addslashes(filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_STRING)) ;
    $senha =addslashes(filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING)) ;
    //inserir no bd
    $result_msg_cont = "UPDATE funcionario SET senha=:senha WHERE id= $id ";

    $update = $pdo->prepare($result_msg_cont);
    
    $update->bindValue(':senha',password_hash($senha, PASSWORD_DEFAULT));



    if($update-> execute()){
        $_SESSION['msg'] = "<p style= 'color:green;'>Dados Editada com sucesso !</p>";
        header("Location: listarFuncionario.php");
     
    }else{
        $_SESSION['msg'] = "<p style= 'color:red;'>dados não foi Editado !</p>";
        header("Location: listarFuncionario.php");

    }
}
?>