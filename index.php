<?php
session_start();
ob_start();
    include_once('conexao.php');
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SISTEMA LOGIN</title>
    <meta name="description" content="Sistema de cadastramento Fundiário">
    <link rel="stylesheet" href="_css/index.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@fortawesome/fontawesome-free@5.15.4/css/fontawesome.min.css" integrity="sha384-jLKHWM3JRmfMU0A5x5AkjWkw/EYfGUAGagvnfryNV3F9VqM98XiIH7VBGVoxVSc7" crossorigin="anonymous">
</head>
<body>
<center>
<div id="login">


        <h1>Login</h1>
<?php
    $dados = filter_input_array(INPUT_POST, FILTER_DEFAULT);
    

    if(!empty ($dados['sendLogin'])){
        //var_dump($dados);
       $query_usuario = "SELECT id,nome,usuario,perfil,senha FROM funcionario WHERE usuario = :usuario LIMIT 1 ";
        $result_usuario= $pdo->prepare($query_usuario);
        $result_usuario->bindParam(':usuario',$dados['usuario'],PDO::PARAM_STR);

        $result_usuario->execute();


        // verificação do usuario

        if(($result_usuario) and ($result_usuario->rowCount() !=0 )){
            $row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario['senha']);
            //var_dump($row_usuario);
           
            if(password_verify($dados['senha'],$row_usuario['senha']))
           // if($dados['senha'] == $row_usuario['senha'])
            {
                 $_SESSION['id'] =$row_usuario['id'] ;
                 $_SESSION['nome'] =$row_usuario['nome'] ;
                 $_SESSION['perfil']= $row_usuario['perfil'];
                 header("Location: cadFuncionario1.php");
            }else{
                $_SESSION['msg']= "Erro: Usuário ou Senha Inválida!";
            }
        }else{
            $_SESSION['msg']= "Erro: Usuário ou senha Inválido!";
        }




      

        //usuario = '".$dados['usuario']."'
    }


    
?>

        
       
       
       
        <form method="POST"  action="">
            <label for="nome">Usuário:</label>
            <input name="usuario" type="text" id="usuario"  placeholder="Digite seu usuário" autocomplete="off" value="<?php if(isset($dados
            ['usuario'])) {echo $dados['usuario'];}?>"> 
            <label for="senha">Senha:</label>
            <input name='senha' type="password"  id="senha"  placeholder="Digite sua senha">
           <?php
               if(isset($_SESSION['msg'])){
                   echo $_SESSION['msg'];
                   unset($_SESSION['msg']);
               }
           ?>
            <input name='sendLogin' type="submit" value="Login">
        </form>
    </div>  

</center>

</body>
</html> 




