<?php
include('conexao.php');

    $id = $_GET['id'];

    $comandSql = "DELETE FROM TB_FUNCIONARIO WHERE id = '$id'";
    $result = mysqli_query($conn, $comandSql);
    if($result){
        header('Location: usuario.php');
    }

?>