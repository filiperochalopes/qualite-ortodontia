<?php

require("../functions.php");
require("../config-db.php");

session_start(); 

//  Fazer update
if(isset($_POST["guia"])){
    $guia = $_POST["guia"];
    $nova_guia = $_POST["novaGuia"];
    $paciente = $_POST["nome"];

    $mydb->query("UPDATE guias SET numero = '$nova_guia', paciente = '$paciente' WHERE numero = '$guia'");

    $resposta = array(
        "mensagem" => "Alteração realizada com sucesso!",
        "class" => "green"
    );

    echo json_encode($resposta);
}

// mostrar dados
if(isset($_GET["guia"])){
    $guia = $_GET["guia"];

    $pesquisaguia = $mydb->query("SELECT * FROM guias WHERE numero = '$guia' ");

    if($pesquisaguia->num_rows > 0){
        
        while ($row = $pesquisaguia->fetch_assoc()) {
            $htmlForm = '
            <form>
                <input type="text" id="edit_guia" placeholder="Número da Guia" class="form-control top" value="'.$row["numero"].'"/>
                <input type="text" id="edit_paciente" placeholder="Nome do paciente" class="form-control bottom" value="'.$row["paciente"].'"/>
            </form>';

            $resposta = array(
                "json" => array(
                    "numero" => $row["numero"],
                    "paciente" => $row["paciente"]
                ),
                "htmlForm" => $htmlForm,
                "mensagem" => "Dados carregados.",
                "class" => "green"
            );
            
            echo json_encode($resposta);
        }
        
    }else{
        $resposta = array(
            "mensagem" => "Essa guia não pode ser editada pois o paciente já se encontra em atendimento ou já foi atendido",
            "class" => "red"
        );
    
        echo json_encode($resposta);
    }
}