<?php
// Recebe o UID via POST
$UIDresult = $_POST["UIDresult"];

// Gera o código PHP que armazena o UID no arquivo UIDContainer.php
$Write = "<?php $" . "UIDresult='" . $UIDresult . "'; " . "echo $" . "UIDresult;" . " ?>";
file_put_contents('UIDContainer.php', $Write);
?>
