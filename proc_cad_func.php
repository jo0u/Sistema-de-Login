<?php
    
    session_start();
    include "conexao.php";


   $SendCadCont = filter_input(INPUT_POST,'SendCadCont',FILTER_SANITIZE_STRING);

   if($SendCadCont){
       //recebendo dados
    $nome =addslashes(filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING)) ;
    $perfil =addslashes(filter_input(INPUT_POST,'perfil',FILTER_SANITIZE_STRING)) ;
    $usuario =addslashes(filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_STRING)) ;
    $senha =addslashes(filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING)) ;
    //inserir no bd
    $result_msg_cont = "INSERT INTO funcionario(nome,perfil,usuario,senha) VALUES (:nome , :perfil , :usuario , :senha) ";

    $insert = $pdo->prepare($result_msg_cont);
    $insert->bindValue(':nome',ucwords($nome));
    $insert->bindParam(':perfil',$perfil);
    $insert->bindValue(':usuario',$usuario);
    $insert->bindValue(':senha',password_hash($senha, PASSWORD_DEFAULT));


    if($insert-> execute()){
        $_SESSION['msg'] = "<p style= 'color:green;'>Dados Cadastrados com sucesso !</p>";
        header("Location: cadFuncionario1.php");
    }else{
        $_SESSION['msg'] = "<p style= 'color:red;'>Mensagem não foi enviada !</p>";
        header("Location: cadFuncionario1.php");

    }
}
?>