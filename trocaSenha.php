<?php
    session_start();
   ob_start();
    include_once('conexao.php');
    include("header.php");
   
   if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){
        header("Location: index.php");
        
    }
    $id=filter_input(INPUT_GET,'id_usuario',FILTER_SANITIZE_NUMBER_INT);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>
<!--  Formulário  -->    
    <div id="formulario">
        <h2>Editar Usúarios</h2>
        <?php
           $result_msg_cont = "SELECT * FROM funcionario WHERE id =$id";

         $resultado_msg_cont= $pdo->prepare($result_msg_cont);
            $resultado_msg_cont->execute();

           $row_msg_cont = $resultado_msg_cont->fetch(PDO::FETCH_ASSOC);


        ?>
            <form  method="POST" action="proc_edit_func_senha.php">    

                <input type="hidden" name="id" value="<?php
                    if(isset($row_msg_cont['id'])){
                        echo $row_msg_cont['id'];
                    }?>">


                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" value="<?php
                    if(isset($row_msg_cont['nome'])){
                        echo $row_msg_cont['nome'];
                    }
                ?>" disabled=true required>
                <label for="apelido">Usuário:</label>
                <input type="text" name="usuario" id="usuario" placeholder="Digite o nome do usuário" value="<?php
                    if(isset($row_msg_cont['usuario'])){
                        echo $row_msg_cont['usuario'];
                    }
                ?>"  disabled=true required>                
                <label for="">Perfil:</label>
                <!-- <input type="text" name="perfil" id="perfil"  placeholder="Digite o Perfil do Usuário "required>  -->
                <select name="perfil" class='orm-select form-select-sm' aria-label=".form-select-sm example" style="width: 350px;"  disabled=true  >
                <option value="<?php
                    if(isset($row_msg_cont['perfil'])){
                        echo $row_msg_cont['perfil'];
                    }
                ?>"><?php
                if(isset($row_msg_cont['perfil'])){
                    echo $row_msg_cont['perfil'];
                }
            ?></option>
                <option value="Administrador">Administrador</option>
                <option value="Consulta">Consulta</option>
                <option value="Cadastrador">Cadastrador</option>
                <option value="Juridico">Juridico</option>
                <option value="CAF">CAF</option>
                <option value="Analista Técnico">Analista Técnico</option>
                

                </select>
               <label for="">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Digite aqui a senha desejada" value="<?php
                    if(isset($row_msg_cont['senha'])){
                        echo $row_msg_cont['senha'];
                    }
                ?>" required>
                <input type="submit" value="Editar"  name="SendEditSenha">

            </form>
                    
            <?php
            if(isset( $_SESSION['msg'])){
                echo $_SESSION['msg'];
                unset($_SESSION['msg']);
            }
        ?>
    </div>  
    <script>
    
    //window.alert("Login, Com sucesso")
    </script>      
</body>
</html>