<?php
include('conexao.php');
session_start();

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['password']) == true)) {

    //Destruindo dados de sessão inexistente
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    header('Location: login.php');
}

// Pegando ID para associar dados de cada email
$email = $_SESSION['email'];
$comandoSql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email'";
$result = $conn->query($comandoSql);

if ($result->num_rows > 0) {
    $dados = mysqli_fetch_assoc($result);
    $id = $dados['ID_USUARIO'];
}

// Cadastro de Usuario 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = $_POST['nome'];
    $emailF = $_POST['email'];
    $uid = $_POST['uid_hidden'];

    if (!empty($nome) && !empty($uid) && !empty($emailF)) {
        // Verifica se o UID já está em uso para esse usuário
        $sqlVerificaUID = "SELECT * FROM TB_FUNCIONARIO WHERE uid = '$uid'";
        $resultVerificaUID = $conn->query($sqlVerificaUID);

        if ($resultVerificaUID->num_rows > 0) {
            // Se o UID já estiver em uso, redireciona para usuario.php
            header("Location: usuario.php");
            exit();
        } else {
            // Caso o UID não esteja em uso, cadastra no banco
            $sql = "INSERT INTO TB_FUNCIONARIO (nome, uid, email, usuario_id) VALUES ('$nome', '$uid', '$emailF', '$id')";
            if ($conn->query($sql) === TRUE) {
                // echo "Usuário cadastrado com sucesso!"
            }
        }
    }
}



// Tabela

$conn->close();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/sidebar.css">
    <link rel="stylesheet" href="src/css/usuario.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="src/imagens/SLlogo.svg" type="image/svg">

    <title>Cadastro</title>
</head>

<body>
    <?php
    include "sidebar.php";
    ?>
    <div class="main-content">
        <div id="all_itens">
            <div class="title-buttons">
                <h1 id="title_cadastro">Cadastro de usuários</h1>
                <div class="buttons-header">
                    <button class="btn-default cadastrar">Cadastrar novo usuário</button>
                </div>
            </div>
            <div class="table-responsive">
            <table width='100%'>
                <thead>
                    <tr>
                        <td>UID</td>
                        <td>Nome</td>
                        <td>Email</td>
                        <td>Alterar</td>
                        <td>Excluir</td>
                    </tr>
                </thead>
                <tbody>
                    <?php 

                        // Verificando email 
                        $email = $_SESSION['email'];
                        $comandoSql = "SELECT * FROM tb_usuario WHERE email_usuario = '$email'";
                        $result = $conn->query($comandoSql);

                        if ($result->num_rows > 0) {
                                $dados = mysqli_fetch_assoc($result);
                                $id = $dados['ID_USUARIO'];  //Pegando o id para comparar



                                $comandoSql = "SELECT * FROM TB_FUNCIONARIO WHERE usuario_id = '$id';";
                                $result = $conn->query($comandoSql); // Se for id igual, então ele vai puxar na tabela registros so daquele email
                                if ($result) {
                                    while ($dados = mysqli_fetch_assoc($result)) {
                                        $id = $dados['id'];
                                        $nomef = $dados['nome'];
                                        $emailf = $dados['email'];
                                        $uid = $dados['uid'];
                                        // print_r($dados);

                                        echo "
                                        <tr>
                                            <td>$uid</td>
                                            <td>$nomef</td>
                                            <td>$emailf</td>
                                            <td><a href='usuariosDadosAltera.php?id=$id' class='btn-default alterar' style='text-decoration:none;'>Alterar</a> </td>
                                            <td><a href='excluir_usuario.php?id=$id' class='btn-default-vermelho' style='text-decoration:none;'>excluir</a></td>
                                        </tr>";
                                    }
                                }
                                $conn->close();
                            }
                    ?>
                </tbody>
            </table>
            </div>

        </div>
    </div>
    <!-- Modal - cadastro de usuarios -->
    <dialog id="dialog_cadastro">
        <form action="" method="post">
            <div class="header-dialog">
            <h2 class="dialog-title">Cadastrar novo usuário</h2>
            <i class='bx bx-x f'></i>
            </div>
            <div class="dialog-inputs">
                <input type="text" name="nome" id="nome" placeholder="Digite um nome">
                <input type="text" name="email" id="email" placeholder="Digite um email" >
                <div id="id_info">
                    <input type="text" name="uid" id="uid" placeholder="UID" value="">
                    <input type="hidden" name="uid_hidden" id="uid_hidden" value="">
                    <abbr title="Passe o cartão e clique em Travar UID, por favor"><i class='bx bx-info-circle'></i></abbr>
                </div>
            </div>
            <br>
            <div class="botoes">
            <button type="submit" class="btn-default">Cadastrar</button>
            <button type="button" id="travar_uid" class="btn-default">Travar UID</button>
            </div>
        </form>
    </dialog>
    <!-- Fim Modal -->

     <!-- Modal - Alterar -->
    <dialog id="dialog_cadastro1">
        <form action="usuario_altera.php" method="post">
            <div class="header-dialog">
                <h2 class="dialog-title">Alterar usuário</h2>
                <i class='bx bx-x f1'></i>
            </div>
            <div class="dialog-inputs">
                <input type="text" name="nome2" id="nome2" placeholder="<?php echo $nomef ?>">
                <input type="text" name="email2" id="email2" placeholder="<?php echo $emailf ?>">
                <div id="id_info2">
                    <input type="text" name="uid2" id="uid2" placeholder="UID" value="">
                    <input type="hidden" name="uid_hidden2" id="uid_hidden2" value="">
                    <abbr title="Passe o cartão e clique em Travar UID, por favor"><i class='bx bx-info-circle'></i></abbr>
                </div>
            </div>
            <br>
            <div class="botoes">
                <button type="submit" class="btn-default">Cadastrar</button>
                <button type="button" id="travar_uid2" class="btn-default">Travar UID</button>
            </div>
        </form>
    </dialog>
    <!-- Fim Modal 2 -->

    <!-- sidebar -->
    <script src="src/js/menu.js"></script>
    <script src="src/js/usuarios.js"></script>
    <!-- Não mexer, se não vai tomar no boga -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>       

$(document).ready(function() {
    let uidSet = false; // Variável para controlar se o UID já foi definido

    setInterval(function() {
        $.ajax({
            url: "UIDContainer.php",
            success: function(result) {
                if (result.trim() !== "" && !uidSet) {
                    $("#uid").val(result); // Insere o UID no campo
                    $("#uid_hidden").val(result); // Atualiza o campo oculto
                }
            },
            error: function() {
                console.log("Erro ao carregar o UID.");
            }
        });
    }, 500);

    // Trava o UID ao clicar no botão
    $("#travar_uid").click(function() {
        uidSet = true; // Marca que o UID foi definido
        $("#uid").prop("disabled", true); // Desabilita o campo
    });
});

    </script>

</body>

</html>