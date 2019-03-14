<?php

require("../functions.php");
require("../config-db.php");

session_start(); 

$senhaatual = $_POST["senhaatual"];
$senhanova = $_POST["senhanova"];

//pesquisa se existe lugar com a senha nova
$pesquisasenhaatual = $mydb->query("SELECT * FROM usuarios WHERE senha = '".md5($senhaatual)."'");

if($pesquisasenhaatual->num_rows > 0){
    
    $mydb->query("UPDATE  usuarios SET senha = '".md5($senhanova)."' WHERE id = '".$_SESSION["id_usuario"]."'");
    
    $resposta = array(
        "mensagem" => "Modificação de senha realizada com sucesso.",
        "class" => "green"
    );
    
    echo json_encode($resposta);
    
}else{
    $resposta = array(
        "mensagem" => "A senha atual não está correta.",
        "class" => "red"
    );

    echo json_encode($resposta);
}