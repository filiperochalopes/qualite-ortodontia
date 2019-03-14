<?php

require("../functions.php");
require("../config-db.php");

$email = $_POST["email"];
$novasenha = geraSenha();
$novasenhamd5 = md5($novasenha);

    $destinatario = $email;
    $assunto = "[SGG Qualité] - Nova Senha";
    $mensagem = "Sua nova senha é: <strong>". $novasenha ."</strong>";

$pesquisa_email = $mydb->query("SELECT * FROM  usuarios WHERE  email = '$email' ");

if($pesquisa_email->num_rows > 0){
    
    $mydb->query("UPDATE  usuarios SET  senha = '$novasenhamd5' WHERE  `email` = '$email'");
    enviaremail($destinatario, $assunto, $mensagem);
    
    $resposta = array(
        "mensagem" => "Uma nova senha foi enviada para o seu email",
        "class" => "green"
    );

    echo json_encode($resposta);    
}else{

    $resposta = array(
        "mensagem" => "Email não registrado, por favor preencha o campo com um email válido.",
        "class" => "red"
    );

    echo json_encode($resposta);
}

?>