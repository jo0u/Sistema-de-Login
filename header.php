<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="_imagens/favicon.ico" type="image/x-icon">
    <title>Menu | Sistema de login</title>
    <link rel="stylesheet" href="_css/menu.css">
    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.0.9/css/boxicons.min.css' rel='stylesheet'>
    <script type="text/javascript" src="setup.js"></script>
</head>
<body>
    <nav>
        <div class="sidebar close">
            <div class="logo-details">
                
                <div class="iocns-link">
                    <a href="#">
                        <i class='bx bx-book-alt' ></i>
                        <span class="link_name">Funcionarios</span>
                    </a>
                    <i class='bx bxs-chevron-down arrow'></i>
                    </div>
                    <ul class="sub-menu">
                        <li><a class="link_name" href="cadFuncionario1.php">Cadastrar Funcionarios</a></li>
                        <li><a class="link_name" href="listarFuncionario.php">Listar Funcionarios</a></li>
                        <li><a class="link_name" href="pesFuncionario.php">Pesquisar Funcionarios</a></li>
                       
                      
                        <li><a class="#" href="#">SCF</a></li>
                    </ul>


                    
                    
                </li>
                <li>




            <div class="profile-details">
                <div class="profile-content">
                    <img src="img/perfil.jpg" alt="profile">
                </div>
                <div class="name-job">
                    <div class="profile_name"><?php echo $_SESSION['nome']; ?></div>
                    <div class="job"><?php echo $_SESSION['perfil']; ?></div>
                </div>
                <a href="logout.php"><i class='bx bx-log-out' ></i></a>
            </div>
        </li>
    </ul>
        </div>
    </nav>


</head>
<body>


    
</body>
</html>
