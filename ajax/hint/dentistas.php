<?php

require("../../config-db.php");

$get_name = $_GET["nome"];

if($get_name != ""){
    $pesquisapacientes = $mydb->query("SELECT * FROM perfis WHERE funcao = 'dentista' AND nome LIKE '%$get_name%' ORDER BY nome ASC LIMIT 5");

    $items = array();

    while($row = $pesquisapacientes->fetch_assoc()){
        array_push($items, [ $row["nome"], $row["usuario"] ] );
    }

    echo json_encode($items);
}else{
    echo "[]";
}


?>