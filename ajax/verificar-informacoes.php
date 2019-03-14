<?php

require("../config-db.php");
require("../functions.php");

session_start();

$guia = $_POST["guia"];

if($guia != ""){
    $pesquisaguia = $mydb->query("SELECT * FROM guias WHERE numero = $guia");

    while ($row = $pesquisaguia->fetch_assoc()) {

        $dentista = $row["dentista"];
        $atendido = $row["atendido"];
        $paciente = $row["paciente"];
        $atendimento = $row["atendimento"];
        $valor = $row["valor"];
        $descricao = $row["descricao"];

    }

    if($atendido == 0){ //verifica se nao foi atendido

        if($dentista == $_SESSION["id_usuario"]){ //verifica dentista

        $sql = "UPDATE guias SET verificado = '1' WHERE numero = '$guia' ";
        $mydb->query($sql);

        $pesquisaguia_atual = $mydb->query("SELECT * FROM guias WHERE numero = '$guia' LIMIT 1");

        while ($row = $pesquisaguia_atual->fetch_assoc()) {

            $resposta = array(
                "tipo" => "sucesso",
                "mensagem" => "Verifique os dados mostrados e confirme o início da consulta",
                "class" => "green",
                "paciente" => $paciente,
                "atendimento" =>  get_atendimento($atendimento)[0],
                "valor" =>  $valor,
                "descricao" =>  $descricao,
                "dentista" => get_info_perfil($dentista, "nome"),
            );

        }

        echo json_encode($resposta);

        }else{

            $resposta = array(
                "tipo" => "erro",
                "mensagem" => "Você não foi o dentista cadastrado para atender esse paciente",
                "class" => "red"
            );
            
            echo json_encode($resposta);
        }

    }else{

        $resposta = array(
            "tipo" => "erro",
            "mensagem" => "Esse paciente já foi atendido",
            "class" => "red"
        );
        
        echo json_encode($resposta);
    }

}else{
    echo "[]";
}


?>