<?php

require("../config-db.php");
require("../functions.php");

$guia = $_POST["guia"];

if($guia != ""){
    $pesquisaguia_verificada = $mydb->query("SELECT * FROM guias WHERE numero = $guia AND verificado = '1' ");

    // echo $pesquisaguia_verificada->num_rows;

    if($pesquisaguia_verificada->num_rows){
        $sql = "UPDATE guias SET atendido = '1' WHERE numero = '$guia' ";
        $mydb->query($sql);

        $resposta = array(
            "class" => "green",
            "mensagem" => "Seu atendimento já pode ser iniciado"
        );
    }else{
        $resposta = array(
            "mensagem" => "Esse atendimento precisa ser verificado",
            "class" => "red"
        );
    }

    echo json_encode($resposta);

}else{
    echo "[]";
}


?>