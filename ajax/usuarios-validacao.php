<?php

require("../functions.php");
require("../config-db.php");

$id = $_POST["id-usuario"];
$opcao = $_POST["opcao"];
$opcao = $opcao === 'true' ? true : false;
$perfilusuario = get_object_perfil($id);

$pesquisausuario = $mydb->query("SELECT * FROM usuarios WHERE id = $id ");

if($pesquisausuario->num_rows > 0){

    if($opcao){
        $mydb->query("UPDATE usuarios SET validacao = 1, b_del = 0 WHERE `id` = '$id'");
        $resposta = array(
            "mensagem" => "$perfilusuario->nome foi aceito com sucesso.",
            "class" => "green"
        );
    }else{
        $mydb->query("UPDATE usuarios SET validacao = 0, b_del = 1 WHERE `id` = '$id'");
        $resposta = array(
            "mensagem" => "$perfilusuario->nome foi rejeitado.",
            "class" => "red"
        );
    }   

    echo json_encode($resposta);    
}else{

    $resposta = array(
        "mensagem" => "id $id opcao $opcao",
        "class" => "red"
    );

    echo json_encode($resposta);
}

?>