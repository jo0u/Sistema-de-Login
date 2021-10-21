<?php
    
    session_start();
    include "conexao.php";


   $SendEditCont = filter_input(INPUT_POST,'SendEditCont',FILTER_SANITIZE_STRING);

   if($SendEditCont){
       //recebendo dados
       $id =addslashes(filter_input(INPUT_POST,'id',FILTER_SANITIZE_NUMBER_INT));
    $nome =addslashes(filter_input(INPUT_POST,'nome',FILTER_SANITIZE_STRING)) ;
    $perfil =addslashes(filter_input(INPUT_POST,'perfil',FILTER_SANITIZE_STRING)) ;
    $usuario =addslashes(filter_input(INPUT_POST,'usuario',FILTER_SANITIZE_STRING)) ;
   // $senha =addslashes(filter_input(INPUT_POST,'senha',FILTER_SANITIZE_STRING)) ;
    //inserir no bd
    $result_msg_cont = "UPDATE funcionario SET nome=:nome , perfil=:perfil , usuario=:usuario /*, senha=:senha*/ WHERE id= $id ";

    $update = $pdo->prepare($result_msg_cont);
    $update->bindValue(':nome',ucwords($nome));
    $update->bindParam(':perfil',$perfil);
    $update->bindValue(':usuario',$usuario);
   // $update->bindValue(':senha',password_hash($senha, PASSWORD_DEFAULT));



    if($update-> execute()){
        $_SESSION['msg'] = "<p style= 'color:green;'>Dados Editada com sucesso !</p>";
        header("Location: listarFuncionario.php");
        var_dump($senhaHas);
    }else{
        $_SESSION['msg'] = "<p style= 'color:red;'>dados não foi Editado !</p>";
        header("Location: listarFuncionario.php");

    }
}
?>