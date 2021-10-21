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
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar</title>
</head>
<body>
    
    <center><h1>Listar</h1>
    
    <?php
    //Recebendo o numero da pagina
    $pagina_atual = filter_input(INPUT_GET, "page", FILTER_SANITIZE_NUMBER_INT);

    $pagina= (!empty($pagina_atual)) ? $pagina_atual : 1 ;
    //var_dump($pagina);

    $limite_resultado = 4;

    // Calcular o inicio da visualização

    $inicio = ($limite_resultado * $pagina) - $limite_resultado;

    //selecioanr as paginas e ordernar pelo id a listagem
    //var_dump($pagina);
      $query_usuario =  "SELECT id,nome,usuario,perfil FROM funcionario ORDER BY id LIMIT $inicio,$limite_resultado";
     $result_usuario= $pdo->prepare($query_usuario);
        $result_usuario -> execute();


        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            echo "<table  border = '1px' ><tr> <th> Nome </th> <th> Usuario </th><th> Perfil </th> <th>Ações</th> </tr><br><br>";
            
            while($row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC)){
                //var_dump($row_usuario);
                echo "<br>";
                extract($row_usuario);
                
               echo "<tr><td>".$nome."</td><td>".$usuario."</td><td>".$perfil."</td>";
                echo "<td><a href ='visualizar.php?id_usuario=$id'>[Visualizar]</a>";
                echo "<a href ='editFuncionario.php?id_usuario=$id'> [Editar]</a></td>";
                echo "<td><a href ='deletarFuncionario.php?id_usuario=$id'> [Deletar]</a></td></tr>";
                
                
                
                
            }
            //contar registros
            $query_qnt_registros = "SELECT COUNT(id) AS num_result FROM  funcionario";
        $result_qnt_registros = $pdo->prepare($query_qnt_registros);
        $result_qnt_registros->execute();
        $row_qnt_registros =  $result_qnt_registros->fetch(PDO::FETCH_ASSOC);
           // 
            //quantidade de pagina;
            $qnt_pagina = ceil($row_qnt_registros['num_result'] / $limite_resultado);

           //var_dump($qnt_pagina);

           $maximo_link = 2;

           echo "<a href='listarFuncionario.php?page=1'><< </a> ";

           for ($pagina_anterior = $pagina - $maximo_link; $pagina_anterior <= $pagina - 1; $pagina_anterior++) {
               if ($pagina_anterior >= 1) {
                   echo "<a href='listarFuncionario.php?page=$pagina_anterior'> $pagina_anterior </a> ";
               }
           }

           echo "$pagina ";

           for ($proxima_pagina = $pagina + 1; $proxima_pagina <= $pagina + $maximo_link; $proxima_pagina++) {
               if ($proxima_pagina <= $qnt_pagina) {
                   echo "<a href='listarFuncionario.php?page=$proxima_pagina'> $proxima_pagina </a> ";
               }
           }

           echo "<a href='listarFuncionario.php?page=$qnt_pagina'> >> </a> ";
       } else {
           echo "<p style='color: #f00;'>Erro: Nenhum usuário encontrado!</p>";
       }
       echo "</table>";

       if(isset( $_SESSION['msg'])){
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
       ?>


    
    
    
  


</center>



</body>
</html>