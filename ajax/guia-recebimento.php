<?php

require("../config-db.php");
require("../functions.php");

$guia = $_POST["guia"];
$valor = $_POST["valor"];
$now = date("Y-m-d H:i:s");;


if($guia != ""){
    $pesquisaguia = $mydb->query("SELECT * FROM guias WHERE numero = $guia");

    if($pesquisaguia->num_rows === 1){ //verifica se a guia realmente existe em um único registro

    $sql = "UPDATE guias SET b_pago = '1', valor_pago = '$valor', `datahora_pago` = '$now' WHERE numero = '$guia' ";

    $mydb->query($sql);

    $pesquisaguia_atual = $mydb->query("SELECT * FROM guias WHERE numero = '$guia' LIMIT 1");

    while ($row = $pesquisaguia_atual->fetch_assoc()) {

        $resposta = array(
            "mensagem" => "Guia atualizada",
            "class" => "green",
            "dentista" => get_info_perfil($row["dentista"], "nome"),
            "texto" => "Valor esperado: R$".$row["valor"].".<br/>Valor pago: R$".$row["valor_pago"]
        );

    }
    
    echo json_encode($resposta);

    }else{

        $resposta = array(
            "mensagem" => "Essa guia não existe nos cadastros",
            "class" => "red"
        );
        
        echo json_encode($resposta);

    }

}else{
    echo "[]";
}


?>