<?php
header('Content-Type: application/json');
// session_start();
include('conexao.php');
// var_dump($_POST);

$email = $_POST['email'];

// Verifica se o campo de email foi enviado
if (!empty($_POST['email'])) {

    $stmt = $conn->prepare("SELECT * FROM TB_USUARIO WHERE EMAIL_USUARIO = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Se o email já existe
        echo json_encode(["status" => "failed"]);
        // $msg = "Este E-mail já está em uso! Tente novamente.";
        // echo "<script type='text/javascript'>alert('$msg');</script>";
        header('Location: cadastro.php');
    } else {
        // Se o email não existe
        echo json_encode(["status" => "success"]);
        $nome = $_POST['name'];
        $senha = $_POST['password'];


        if(!empty($_POST['name']) && !empty($_POST['password'])){
            $sql = "INSERT INTO TB_USUARIO (NOME_USUARIO, EMAIL_USUARIO, SENHA_USUARIO) VALUES ('$nome', '$email', '$senha')";
            $result = mysqli_query($conn, $sql);

            header('Location: login.php');
        }
        else {
            header('Location: cadastro.php');
        }
    }

    $stmt->close();
    $conn->close();
} else {
    // Retorna erro se o campo de email não foi fornecido
    echo json_encode(["status" => "error", "message" => "Email não fornecido"]);
    header('Location: cadastro.php');
}
?>
