<?php

require("../../functions.php");
require("../../config-db.php");
require("../../config-globals.php");

session_start();

$email = $_POST["email"];
$senhamd5 = md5($_POST["senha"]);

$pesquisa_email = $mydb->query("SELECT * 
FROM usuarios WHERE `email` = '$email' ");

if($pesquisa_email->num_rows > 0){
    
    //checa senha
    while ($row = $pesquisa_email->fetch_assoc()) {
        if($row["senha"] == $senhamd5){

            if($row["validacao"]){       
                $_SESSION["id_usuario"] = $row["id"];
                $_SESSION["email"] = $row["email"];
                header("Location: ".$home);
            }else{
                header("Location: ".$domain."aguarde");  
            }
            
        }else{
            header("Location: ".$domain."?erro=Senha incorreta, por favor insira corretamente");       
        }
    }
    
}else{

    header("Location: ".$domain."?erro=Email não cadastrado.");
}

?>