<?php 

require_once(__DIR__ ."/../../config-globals.php");
//require(__DIR__ ."/../functions.php");
//sempre na página declarar primeiro functions.php, chamada na página main

if(permissao($permissao)){
    
}else{
    echo "permissao negada";
    header("Location: ". $denied); 
    exit; 
}
    
?> 