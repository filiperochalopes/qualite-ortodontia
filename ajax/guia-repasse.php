<?php

require("../config-db.php");
require("../functions.php");

$id = $_POST["id"];
$valor = $_POST["valor"];
$now = date("Y-m-d H:i:s");;


if($id != ""){

    $sql = "UPDATE guias SET b_repasse = '1', valor_repasse = '$valor', `datahora_repasse` = '$now' WHERE id = '$id' ";

    $mydb->query($sql);

    $resposta = array(
        "mensagem" => "Marcado como repassado",
        "class" => "green",
    );
    
    echo json_encode($resposta);

}else{
    echo "[]";
}


?>