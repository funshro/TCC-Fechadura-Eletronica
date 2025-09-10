<?php
include('conexao.php');

// Verifica se o UID foi passado via GET ou POST
if (isset($_GET['uid']) || isset($_POST['uid'])) {
    // Recebe o UID
    $uid = isset($_GET['uid']) ? $_GET['uid'] : $_POST['uid'];

    // Insere o UID no banco de dados
    $sql = "INSERT INTO uids (uid) VALUES ('$uid')";
    if ($conn->query($sql) === TRUE) {
        echo "UID inserido com sucesso!";
        
        // Atualiza o arquivo UIDContainer.php
        $Write = "<?php $" . "UIDresult='" . $uid . "'; " . "echo $" . "UIDresult;" . " ?>";
        file_put_contents('UIDContainer.php', $Write);
    } else {
        echo "Erro ao inserir UID: " . $conn->error;
    }
} else {
    echo "Nenhum UID foi enviado.";
}

$conn->close();
?>
