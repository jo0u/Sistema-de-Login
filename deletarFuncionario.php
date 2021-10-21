<center>
<?php
      session_start();
      ob_start();
      include_once('conexao.php');
       include("header.php");
      
      if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){
           header("Location: index.php");
           
       }


     $id = filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
       var_dump($id);

       if(empty($id)){
        $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não encontrado !</p>";
        header("Location: listarFuncionario.php");
        exit();
       }

      $query_usuario= "SELECT id FROM funcionario WHERE id = $id LIMIT 1";
       $result_usuario= $pdo->prepare($query_usuario);
       $result_usuario->execute();

       if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
       $query_del_usuario=  "DELETE FROM funcionario WHERE id = $id";
       $apagar_usuario = $pdo->prepare($query_del_usuario);
        if($apagar_usuario->execute()){
            $_SESSION['msg'] = "<p style= 'color:green;'>Usuario Apagado !</p>";
            header("Location: listarFuncionario.php");
        }else{
            $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não foi deletado !</p>";
        header("Location: listarFuncionario.php");
        exit();
        }
       }else{
        $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não encontrado !</p>";
        header("Location: listarFuncionario.php");
        exit();
       }

?>
</center>