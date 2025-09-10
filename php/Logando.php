<?php 
    session_start();

    //validação dos campos
    if(isset($_POST['submit']) && !empty($_POST['email']) && !empty($_POST['password'])){ 
        // Acessou 

        
        // conexão com banco
        include('conexao.php');

        $email = $_POST['email'];
        $senha = $_POST['password'];
        
        //verificação para ver se existe no banco
        $sql = "SELECT * FROM TB_USUARIO WHERE EMAIL_USUARIO = '$email' AND SENHA_USUARIO = '$senha'";

        $result = $conn->query($sql);

        //Logando no sistema
        if(mysqli_num_rows($result) < 1){
            //Destruindo dados inexistentes
            unset($_SESSION['email']);
            unset($_SESSION['password']);
            header('Location: login.php');
            //Não logado
        } else{
            //Armazenando dados existente
            while($dados=mysqli_fetch_assoc($result)){
                $nome=$dados["NOME_USUARIO"];
                $_SESSION['nome_usuario'] = $nome;
            }

            $_SESSION['email'] = $email;
            $_SESSION['password'] = $senha;
            
            header('Location: menu.php');
            

            
            //Logado
        }
    } else{
        header('Location: login.php');
        // Não acessou
    }

?>