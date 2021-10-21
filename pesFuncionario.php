<?php
session_start();
ob_start();
    
    include_once('conexao.php');
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
    <title>Pesquisar</title>
</head>
<body>
   <br> 
   <a href="cadFuncionario1.php">Voltar</a>
    <center>
   <h1 style= margin-left:30px;>Pesquisar Usuario</h1>

   <?php
         $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
       /*  $pagina_atual = filter_input(INPUT_GET,"page", FILTER_SANITIZE_STRING);
         $pagina= (!empty($pagina_atual)) ? $pagina_atual : 1 ;
         var_dump($pagina);

         $limite_res = 2;
         //calcular o inicio da visualização
         $inicio = ($limite_res * $pagina) - $limite_res;
         */
   ?>

    <form method='POST' action="">
    <label style= margin-left:10;>Nome</label>
    <input type="text" name="nome_usuario" placeholder="Digete o nome" value="<?php
         if(isset($dados['nome_usuario'])){
            echo $dados['nome_usuario'];
         }else{
          $_SESSION['msg'] = "<p style= 'color:red;'>Usuário não foi Editado !</p>";
         
  
         }

    ?>">
    <input type="submit" name='pesqUsuario' id="pesqUsuario" style= margin-left:15px;>


    </form>



    <?php 
    IF(!empty($dados['pesqUsuario'])){

        
      // echo var_dump($dados);
?>
<br>
<?php

        //busca do usuario
        $nome = "%".$dados['nome_usuario']."%";



       //busca dos dados e ordernar de forma alfabetica 

       $query_usuario="SELECT * FROM funcionario WHERE nome LIKE :nome ORDER BY nome ASC ";
       //LIMIT $inicio,$limite_res
        $result_usuarios = $pdo->prepare($query_usuario);
        $result_usuarios-> bindParam(":nome",$nome,PDO::PARAM_STR);
        $result_usuarios->execute();
        echo "<table  border = '1px' ><tr> <th> Nome </th> <th> Usuario </th><th> Perfil </th> <th>Ações</th> </tr><br><br>";
        while($row_usuario = $result_usuarios->fetch(PDO::FETCH_ASSOC)){
            //var_dump($row_usuario);

            extract($row_usuario);

            /*echo "ID: ".$id. "<br><br>";
            echo "Nome: ".$nome. "<br><br>";
            echo "Perfil: ".$perfil. "<br><br>";
            echo "Usuário: ".$usuario. "<br><br>";
           
            
            echo "<a href ='editar.php?id_usuario=$id'> [Editar]</a>";
            echo "<hr>";
            */

            //Referencias e links

            echo "<tr><td>".$nome."</td><td>".$usuario."</td><td>".$perfil."</td>";
            echo "<td><a href ='visualizar.php?id_usuario=$id'>[Visualizar]</a>";
            echo "<a href ='editFuncionario.php?id_usuario=$id'> [Editar]</a></td>";
            echo "<td><a href ='deletarFuncionario.php?id_usuario=$id'> [Deletar]</a></td></tr>";
        
        }
      /*  $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM  funcionario";
        $result_qnt_registros = $pdo->prepare($query_qnt_registros);
        $result_qnt_registros->execute();
    $row_qnt_linha =  $result_qnt_registros->fetch(PDO::FETCH_ASSOC);

   /* //quantidade de página
    ceil($row_qnt_linha['num_result'] / $limite_res);

    echo "<a href='pesFuncionario.php?page=1'>primeira</a>";
    echo "<a href='#'>$pagina</a>";
    echo "<a href='pesFuncionario.php?page=2'>2</a>";
    echo "<a href='#'>$pagina</a>";*/
    }
   
    echo "</table>";
   
    ?>
    </center>
</body>
</html>