<?php

require("../functions.php");
require("../config-db.php");

$id = $_POST["id"];
$edit = $_POST["edit"];
$valor = $_POST["valor"];

$mydb->query("UPDATE perfis SET `$edit` = '$valor' WHERE id = $id;
")or die("Erro de inserção");

$resposta = array(
    "mensagem" => ucfirst($edit)." editado(a) com sucesso.",
    "class" => "green"
);

echo json_encode($resposta);

?>