<?php 
include('conexao.php');

if($_SERVER["REQUEST_METHOD"] == "POST"){

    $nome =$_POST['Nome'];
    $email =$_POST['E-mail'];
    $uid =$_POST['uid_hidden'];
    $id_u =$_POST['id_usuario'];

    if (!empty($nome) && !empty($email) && !empty($uid)){

    $comandSql = "UPDATE tb_funcionario SET nome = '$nome', email = '$email', uid = '$uid' WHERE id = '$id_u';";
    $result = mysqli_query($conn, $comandSql);
    if($result){
        header('Location: usuario.php');
        }
    } else{
        header('Location: usuario.php');
    }
}
?>