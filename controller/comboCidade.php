<?php

include_once('../config/conexao.php');

$estado = $_POST['estado'];

$conn = conexao();
$stmt = $conn->prepare("SELECT * FROM cidade WHERE estadoid = $estado ORDER BY cidadeid;");
$stmt->execute();

$cidades = $stmt->fetchAll(PDO::FETCH_ASSOC);

foreach ($cidades as $key => $value) {
    echo "<option value=\"" . $value['cidadeid'] . "\" selected=\"selected\">" . $value['nome'] . "</option>";
}
?>