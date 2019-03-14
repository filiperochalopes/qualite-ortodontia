<?php 

require("./config-globals.php");

session_start(); 

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["email"])){ 
// Usuário não logado! Redireciona para a página de login 
header("Location: ".$domain); 
exit; 
}
    
?> 