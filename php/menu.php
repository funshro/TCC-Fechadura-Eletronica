<?php
session_start();

//validando sessão
if ((!isset($_SESSION['email']) == true) and (!isset($_SESSION['password']) == true)) {

    //Destruindo dados de sessão inexistente
    unset($_SESSION['email']);
    unset($_SESSION['password']);
    header('Location: login.php');
    exit;
}



?>
<!DOCTYPE html>
<html lang="en">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="src/css/sidebar.css">
    <link rel="stylesheet" href="src/css/menu2.css">
    <link rel="stylesheet" href="src/css/menu.css">

    <!-- Line Awesome -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/line-awesome/1.3.0/line-awesome/css/line-awesome.min.css"
        integrity="sha512-vebUliqxrVkBy3gucMhClmyQP9On/HAWQdKDXRaAlb/FKuTbxkjPKUyqVOxAcGwFDka79eTF+YXwfke1h3/wfg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <!-- Boxicons CSS -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

    <link rel="shortcut icon" href="src/imagens/SLlogo.svg" type="image/svg">
    <title>Menu</title>
</head>

<body>

    <?php
    include "sidebar.php";
    ?>

    <div class="main-content">
        <header id="header_main">
            <h1>
                Dashboard
            </h1>
        </header>

        <main>

            <div class="cards">
                <div class="card-single">
                    <?php
                    // include('conexao.php');

                    // Verificando o email da sessão
                    // $email = $_SESSION['email'];
                    
                    $sql = "
                        SELECT COUNT(*) AS total_acessos
                        FROM uids 
                        WHERE timestamp >= NOW() - INTERVAL 1 DAY 
                        AND uid IN (
                            SELECT uid 
                            FROM TB_FUNCIONARIO 
                            JOIN tb_usuario us ON TB_FUNCIONARIO.usuario_id = us.ID_USUARIO
                            WHERE us.email_usuario = '$email'
                        );
                    ";
                    
                    $result = $conn->query($sql);
                    
                    if ($result) {
                        $row = $result->fetch_assoc();
                        $total_acessos = $row['total_acessos']; // Captura o número total de acessos
                    } else {
                        $total_acessos = 0; // Caso a query falhe ou não tenha resultados
                    }
                    
                    // Exibe o total de acessos
                    echo "<div>";
                    echo "<h1>" . htmlspecialchars($total_acessos) . "</h1>"; // Protegendo contra XSS
                    echo "<span>Acessos</span>";
                    echo "</div>";
                    ?>
                    <div>
                        <span class="las la-users"></span>
                    </div>
                </div>
                <div class="card-single">
                    <?php 
                    $sql_recente = "
                    SELECT f.nome, uid.timestamp
                    FROM TB_FUNCIONARIO f
                    JOIN tb_usuario u ON f.usuario_id = u.ID_USUARIO
                    JOIN uids uid ON f.uid = uid.uid
                    WHERE u.email_usuario = '$email'
                    ORDER BY uid.timestamp DESC
                    LIMIT 1;";
                    
                    $result_recente = $conn->query($sql_recente);
                    $nome_recente = "Sem acessos"; // Valor padrão caso não haja registros
                    $horario_recente = "--:--"; // Valor padrão para o horário
                    
                    if ($result_recente && $result_recente->num_rows > 0) {
                        $row_recente = $result_recente->fetch_assoc();
                        $nome_recente = $row_recente['nome']; // Captura o nome da pessoa mais recente
                        $horario_recente = date("H:i", strtotime($row_recente['timestamp'])); // Captura o horário e formata para H:i
                    }
                    
                    ?>
                    <div>
                        <h1><?php echo htmlspecialchars($nome_recente); ?></h1>
                        <span>Recentes</span>
                    </div>
                    <div>
                        <!-- <img src="src/imagens/avatar.png" width="65px" height="65px" alt=""> -->
                    </div>
                </div>
                <div class="card-single">
                    <div>
                        <h1><?php echo htmlspecialchars($horario_recente); ?></h1>
                        <span>Último horário</span>
                    </div>
                    <div>
                        <span class="fa-regular fa-clock"></span>
                    </div>
                </div>
                <div class="card-single">
                    <div class="card-clock">
                        <h2 id="horas">00</h2>
                        <span>:</span>
                        <h2 id="minutos">00</h2>
                        <span>:</span>
                        <h2 id="segundos">00</h2>
                    </div>
                </div>
            </div>


            
            <div class="recent-grid">
                <div class="projects">
                    <div class="card">
                        <div class="card-header">
                            <h3>Histórico</h3>
                            <form method="get"></form>
                            <div class="search-box">
                                <i class='bx bx-search icon'></i>
                                <input type="text" id="input_busca" placeholder="Procurar...">
                            </div>

                            

                            <!-- <button>Ver todos <span class="las la-arrow-right btn-default"></span></button> -->
                        </div>
                  
                        <div class="card-body">
                            <div class="table-responsive">
                                <table width="100%">
                                    <thead>
                                        <tr>
                                            <td>Usuários</td>
                                            <td>Fechaduras</td>
                                            <td>Datas/horas</td>
                                            <td>Status</td>
                                        </tr>
                                    </thead>
                                    <tbody id="tabela_historico">
                                        <?php

                                        include('conexao.php');


                                        $email = $_SESSION['email'];

$sql = "SELECT f.nome, f.uid, u.timestamp, u.tipo_evento 
        FROM TB_FUNCIONARIO f 
        JOIN tb_usuario us ON f.usuario_id = us.ID_USUARIO 
        JOIN uids u ON f.uid = u.uid 
        WHERE us.email_usuario = '$email'
        ORDER BY u.timestamp DESC 
        LIMIT 100;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Saída dos dados de cada linha
    while ($row = $result->fetch_assoc()) {
        $nome = $row['nome'];
        $uid = $row['uid']; 
        $timestamp = $row['timestamp'];
        $tipo_evento = $row['tipo_evento']; // Captura o tipo_evento

        echo "<tr>";
        echo "<td>" . htmlspecialchars($nome) . "</td>"; // Use htmlspecialchars para evitar XSS
        echo "<td>ESP32 - 01</td>";
        echo "<td>";
        
        // Formatar a data e a hora com um espaço e um traço
        $formatted_date = date("d/m/Y - H:i:s", strtotime($timestamp));
        echo $formatted_date; // Exibe a data e hora formatada
        echo "</td>";
        echo "<td>" . htmlspecialchars($tipo_evento) . "</td>"; // Exibe o tipo_evento
        echo "</tr>";
    }
} else {
    echo "<tr><td colspan='4'>Nenhum registro ainda...</td></tr>"; // Atualize o colspan para 4
}

                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="customers">
    <div class="card-customer">
        <div class="card-header">
            <h3>Pessoas cadastradas</h3>
        </div>

        <div class="card-body">
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
                            $nomef = $dados['nome'];
                            echo "
                            <div class='customer'>
                                <div class='info'>
                                    <div>
                                        <h4>$nomef</h4>
                                    </div>
                                </div>
                            </div>";
                        }
                    }
                    $conn->close();
                }
            ?>
        </div>
    </div>
</div>

            </div>

        </main>
        <div>

            <script src="src/js/menu.js"></script>
            <script src="src/js/horas.js"></script>
            <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- <script>
function atualizarTabela() {
    $.ajax({
        url: 'atualizar_tabela.php', // URL do arquivo que busca os dados
        type: 'GET',
        success: function(data) {
            $('#tabela_historico').html(data); // Atualiza o corpo da tabela com os novos dados
        },
        error: function() {
            alert("Erro ao atualizar a tabela.");
        }
    });
}

// Chama a função para atualizar a tabela a cada 5 segundos (5000 milissegundos)
setInterval(atualizarTabela, 5000);
</script> -->

</body>

</html>