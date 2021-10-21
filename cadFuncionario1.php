<?php
    session_start();
   ob_start();
    include("header.php");
   
   if(!isset($_SESSION['id']) and (!isset($_SESSION['nome']))){
        header("Location: index.php");
        
    }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">

</head>
<body>
<!--  Formulário  -->    
    <div id="formulario">
        <h2>Cadastro Usúarios</h2>
            <form  method="POST" action="proc_cad_func.php">    
                <label for="nome">Nome:</label>
                <input type="text" name="nome" id="nome" placeholder="Digite o nome completo" required>
                <label for="apelido">Usuário:</label>
                <input type="text" name="usuario" id="usuario" placeholder="Digite o nome do usuário" required>                
                <label for="">Perfil:</label>
                <!-- <input type="text" name="perfil" id="perfil"  placeholder="Digite o Perfil do Usuário "required>  -->
                <select name="perfil" class='orm-select form-select-sm' aria-label=".form-select-sm example" style="width: 350px;"  >
                <option value="Administrador">Administrador</option>
                <option value="Consulta">Consulta</option>
                <option value="Cadastrador">Cadastrador</option>
                <option value="Juridico">Juridico</option>
                <option value="CAF">CAF</option>
                <option value="Analista Técnico">Analista Técnico</option>
                

                </select>
                <label for="">Senha:</label>
                <input type="password" name="senha" id="senha" placeholder="Digite aqui a senha desejada" required>
                <input type="submit" value="Cadastrar"  name="SendCadCont">
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