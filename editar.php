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
        <h1>Editar</h1>
<?php
    //Receber os dados do Formulario

//verificar se o usuário clicou no botão 
$dados = filter_input_array(INPUT_POST,FILTER_DEFAULT);
    if(!empty($dados['EditUsuario'])){
       // var_dump($dados);
        $empty_input = false;
        $dados = array_map('trim',$dados);
        if(in_array("",$dados)){
            $empty_input = true;
            echo "Erro Necessário preencher todos os campos";
        }
        if(!$empty_input){
            $query_up_usuario= "UPDATE funcionario SET nome = :n,usuario = :u , perfil = :p , senha = :s WHERE id = :id";
            $edit_usuario= $pdo->prepare($query_up_usuario);
            $edit_usuario->bindParam(':n',$dados['nome'], PDO::PARAM_STR); 
            $edit_usuario->bindParam(':u',$dados['usuario'], PDO::PARAM_STR); 
            $edit_usuario->bindParam(':p',$dados['perfil'], PDO::PARAM_STR); 
           $edit_usuario->bindParam(':s',$dados['senha'], PDO::PARAM_STR); 
            $edit_usuario->bindParam(':id',$id,PDO::PARAM_INT); 
           
          
            if($edit_usuario->execute()){
                echo "Usuário editado!";
               // header("Location: listarFuncionario.php");
               
            }else{
                echo "Erro: Usuário Não editado!";
            }
        }
    }



$id = filter_input(INPUT_GET,"id_usuario",FILTER_SANITIZE_NUMBER_INT);
if(empty($id)){
    $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não encontrado !</p>";
    header("Location: listarFuncionario.php");
    exit();
   }
  
   //var_dump($id);

  $query_usuario = "SELECT id,nome,usuario,perfil,senha FROM funcionario WHERE id = $id LIMIT 1";
       $result_usuario=$pdo->prepare($query_usuario);
        $result_usuario->execute();

        if(($result_usuario) AND ($result_usuario->rowCount() != 0)){
            $row_usuario= $result_usuario->fetch(PDO::FETCH_ASSOC);
            //var_dump($row_usuario);

        }else{
            $_SESSION['msg'] = "<p style= 'color:red;'>Erro: Usuário não encontrado !</p>";
    header("Location: listarFuncionario.php");
    exit();
        }
        
      


            
             
        ?>
          <form  method="POST">    
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" value="<?php
                    
                    if (isset($dados['nome'])) {
                        echo $dados['nome'];
                    } elseif (isset($row_usuario['nome'])) {
                        echo $row_usuario['nome'];
                    }
                    
                ?>" >


                <label for="apelido">Usuário:</label>
                <input type="text" name="usuario" id="usuario" placeholder="Digite o nome do usuário"  value="<?php
                
                if(isset($dados['usuario'])){
                    echo $dados['usuario'];
                }elseif(isset($row_usuario)){ 
                    echo $row_usuario['usuario'];
                }
                
                ?>" required>               


                <label for="">Perfil:</label>
                <input type="text" name="perfil" id="perfil"  placeholder="Digite o Perfil do Usuário" value = "<?php
                     
                     if (isset($dados['perfil'])) {
                        echo $dados['perfil'];
                    } elseif (isset($row_usuario['perfil'])) {
                        echo $row_usuario['perfil'];
                    }
                ?>" required> 
               
<!--
                <option value="Administrador">Administrador</option>
                <option value="Consulta">Consulta</option>
                <option value="Cadastrador">Cadastrador</option>
                <option value="Juridico">Juridico</option>
                <option value="CAF">CAF</option>
                <option value="Analista Técnico">Analista Técnico</option>
                

                </select> -->
                <label for="">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Digite aqui a senha desejada" value="<?php

                    if (isset($dados['perfil'])) {
                        echo $dados['perfil'];
                    } elseif (isset($row_usuario['senha'])) {
                        echo $row_usuario['senha'];
                    }
                ?>" required>


                <input type="submit" value="Salvar"  name="EditUsuario">
            </form>


    </center>


</body>
</html>