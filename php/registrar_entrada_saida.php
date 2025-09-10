<?php
include('conexao.php');

// Verifica se o UID foi passado via GET ou POST
if (isset($_GET['uid']) || isset($_POST['uid'])) {
    // Recebe o UID
    $uid = isset($_GET['uid']) ? $_GET['uid'] : $_POST['uid'];

    // Primeiro, insere o UID na tabela 'uids'
    $sqlInsert = "INSERT INTO uids (uid) VALUES ('$uid')";
    if ($conn->query($sqlInsert) === TRUE) {
        echo "UID inserido com sucesso! ----- ";

        // Atualiza o arquivo UIDContainer.php
        $Write = "<?php $" . "UIDresult='" . $uid . "'; " . "echo $" . "UIDresult;" . " ?>";
        file_put_contents('UIDContainer.php', $Write);
        
        // Após a inserção, verifica se o UID existe na tabela 'TB_FUNCIONARIO'
        $sqlCheck = "SELECT * FROM TB_FUNCIONARIO WHERE uid = '$uid'";
        $result = $conn->query($sqlCheck);

        if ($result->num_rows > 0) {
            // UID encontrado
            echo "UID encontrado na tabela de funcionários.";
        } else {
            // UID não encontrado
            echo "UID não encontrado na tabela de funcionários.";
        }
    } else {
        echo "Erro ao inserir UID: " . $conn->error;
    }
} else {
    echo "Nenhum UID foi enviado.";
}

$conn->close();
?>
