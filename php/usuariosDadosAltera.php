<?php 
session_start();

if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['password']) == true)) {

    //Destruindo dados de sessão inexistente
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    header('Location: login.php');
}

include('conexao.php');

$id_u = $_GET["id"];
    $comandSql = "SELECT * FROM tb_funcionario WHERE id ='$id_u'";
    $result = mysqli_query($conn, $comandSql);
if($result){
    $dados = mysqli_fetch_assoc($result);
    $uidf = $dados['uid'];
    $nomef = $dados["nome"];
    $emailf = $dados["email"];

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="src/css/usuariosDados.css">
    <link rel="stylesheet" href="src/css/sidebar.css">

    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="src/imagens/SLlogo.svg" type="image/svg">
    <title>Alterar</title>
</head>
<body>
<?php
    include "sidebar.php";
 ?>

<form action="usuario_altera.php" method="post">
    <h1>ALTERAR DADOS USUÁRIO</h1>
    <div class="campos">
        <div class="campo">
            <input type="text" id="id_usuario" name="id_usuario" value="<?php echo $id_u ?>" hidden>
        </div>
        <div class="campo">
            <label for="uid">UID</label>
            <div class="class-uid">
                <input type="text" id="uid" placeholder="UID" value="<?php echo $uidf ?>">
                <input type="hidden" id="uid_hidden" name="uid_hidden" value="">
                <abbr title="Passe o cartão e clique em Travar UID, por favor"><i class='bx bx-info-circle'></i></abbr>
            </div>
        </div>
        <div class="campo">
            <label for="nome">Nome</label>
            <input type="text" id="nome" placeholder="Nome" name="Nome" value="<?php echo $nomef ?>">
        </div>
        <div class="campo">
            <label for="email">E-mail</label>
            <input type="text" id="email" placeholder="E-mail" name="E-mail" value="<?php echo $emailf ?>">
        </div>
        <div class="buttons-form">
            <button type="submit" class="btn-default">Alterar</button>
            <button type="button" id="travar_uid" class="btn-default">Travar UID</button>
        </div>
    </div>
</form>


    <script src="src/js/menu.js"></script>
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