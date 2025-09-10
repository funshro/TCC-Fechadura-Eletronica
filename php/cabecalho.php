<!DOCTYPE html>
<html lang="pt-br">

<head>
  <!-- Meta tags Obrigatórias -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
    integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
  <style>
    .sair {
      float: right;
    }
  </style>
</head>

<body>
  <div class="container">
    <?php
    /*1 - Incluir a conexão*/
    include "conexao.php";

    /*2 - Pegando o id do usuário vindo pela url */
    $id = $_GET["id"];

    /*3 - Criando o comando sql para pegar os dados do usuário que logou */
    $comandoSql = "select NOME_USUARIO, EMAIL_USUARIO, SENHA_USUARIO from TB_USUARIO where ID_USUARIO=$id";

    /*4 - Executando o comando sql criado acima e pegando o resultado */
    $resultado = mysqli_query($conn, $comandoSql);
    $dados = mysqli_fetch_assoc($resultado);

    $nome = $dados["NOME_USUARIO"];
    $email = $dados["EMAIL_USUARIO"];
    $senha = $dados["SENHA_USUARIO"];

    /*5- Iniciando uso de variável de sessão e armazenando valores */
    session_start();

    $_SESSION["id"] = $id;
    $_SESSION["nome"] = $nome;
    $_SESSION["email"] = $email;
    $_SESSION["senha"] = $senha;

    /*Exibindo as informações do usuário*/
    echo "<div class = 'alert alert-primary' role = 'alert'>";
    echo "Bem vindo, " . $_SESSION['nome'] . " <br>
      Você é usuário " . $_SESSION['id']; // TAVA minusuclo 
    
    echo "<div class='sair'> <a href = 'sair.php'> Sair </a> </div>";
    echo "</div>";

    ?>

  </div>



  <!-- JavaScript (Opcional) -->
  <!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
    integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
    integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy"
    crossorigin="anonymous"></script>
  <script src="js/scripts.js"> </script>
</body>

</html>