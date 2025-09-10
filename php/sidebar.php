<?php 
    if (session_status() == PHP_SESSION_NONE) {
        session_start(); // Inicia a sessão apenas se ainda não estiver ativa
    }
    include('conexao.php');
    $email = $_SESSION['email'];

    $comandoSql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email'";
    $result = $conn->query($comandoSql);

    if ($result->num_rows > 0) {

        $dados = mysqli_fetch_assoc($result);
        // print_r($dados);
            $nome = $dados['NOME_USUARIO'];
            $imagem = !empty($dados['IMAGEM_USUARIO']) ? $dados['IMAGEM_USUARIO'] : " ";        
    } 
?>
<!-- Começo da sidebar -->
<nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image">
                <img src="<?php echo $imagem ?>" alt="" width="40px" height="40px" style="object-fit: cover;">
            </span>

            <div class="text header-text">
                <span class="name"><?php echo $nome ?></span>
                <span class="profession">Admin</span> <!-- PODE TIRAR O PROFESSION DPS PQ ACHO Q NÃO PRECISA -->
            </div>
        </div>

        <i class='bx bx-chevron-right toggle'></i> <!-- Seta para abrir e fechar a sidebar -->
    </header>

    <div class="menu-bar"> <!-- Parte do menu, fazer a separação do top e do bottom -->
        <div class="menu">
<hr>
        <ul class="menu-links">
                <li class="nav-links">
                    <a href="menu.php">
                        <i class='bx bx-home-alt-2 icon'></i>
                        <span class="text nav-text">Página inicial</span>
                    </a>
                </li>
                <li class="nav-links">
                    <a href="usuario.php">
                        <i class='bx bx-user icon'></i>
                        <span class="text nav-text">Usuários</span>
                    </a>
                </li>
                <li class="">
                    <a href="config.php">
                        <i class='bx bx-cog icon'></i>
                        <span class="text nav-text">Configurações</span>
                    </a>
                </li>
            </ul>
        </div>

        <div class="bottom-content">
            <!-- colocar a ul, caso algo dê errado -->
            <li class="">
                <a href="sair.php">
                    <i class='bx bx-log-out icon'></i>
                    <span class="text nav-text">Logout</span>
                </a>
            </li>

            <!-- Definindo tema escuro  -->
            <li class="mode">
                <div class="moon-sun">
                    <i class='bx bx-moon icon moon'></i>
                    <i class='bx bx-sun icon sun'></i>
                </div>

                <span class="mode-text text">Dark Mode</span>

                <div class="toggle-switch">
                    <span class="switch"></span>
                </div>
            </li>
        </div>
    </div>
</nav>