<?php 

include('conexao.php');
session_start();
$emailUser = $_SESSION['email'];

if(!empty($_POST['nome'])){

  $nome = $_POST['nome'];
  $comandoSql="UPDATE tb_usuario SET nome_usuario='$nome' where email_usuario='$emailUser';";
  $result = $conn->query($comandoSql);
  if ($result === true) {
      // Atualizou
      header('Location: config.php');
  } 
} else{
  header('Location: config.php');
}



if (!empty($_POST['email'])) {
  $email = $_POST['email'];

  // Verificar se o email já existe
  $comandoVerifica = "SELECT email_usuario FROM tb_usuario WHERE email_usuario = '$email';";
  $resultVerifica = $conn->query($comandoVerifica);

  if ($resultVerifica->num_rows > 0) {
      header('Location: config.php');
  } else {
      $comandoSql = "UPDATE tb_usuario SET email_usuario = '$email' WHERE email_usuario='$emailUser';";
      $result = $conn->query($comandoSql);
      
      if ($result === true) {
          // Atualizou com sucesso
          unset($_SESSION['email']);
          unset($_SESSION['password']);
          header('Location: login.php');
      }
  }
} else {
  header('Location: config.php');
}



if(!empty($_POST['senha'])){

  $senha = $_POST['senha'];
  $comandoSql="UPDATE tb_usuario SET senha_usuario = '$senha' where email_usuario='$emailUser';";
  $result = $conn->query($comandoSql);
  if ($result === true) {
      // Atualizou
      header('Location: config.php');
  }
} else{
  header('Location: config.php');
}

if(!empty($_FILES['imagem']['name'])){

    $upload_dir = "src/imagens/perfil/";
    $upload_file = $upload_dir . basename($_FILES["imagem"]["name"]);
    move_uploaded_file($_FILES["imagem"]["tmp_name"], $upload_file);

    $imagem = $upload_file;
    // $imagem = $_POST['imagem'];
    $comandoSql="UPDATE tb_usuario SET imagem_usuario = '$imagem' where email_usuario='$emailUser';";
    $result = $conn->query($comandoSql);
    if ($result === true) {
        // Atualizou
        header('Location: config.php');
    }
} else{
  header('Location: config.php');
}
?>