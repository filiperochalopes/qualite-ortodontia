<?php

require("../../config-db.php");

$get_valor = $_GET["str"];

if($get_valor != ""){
    $pesquisapacientes = $mydb->query("SELECT valor FROM guias WHERE valor LIKE '%$get_valor%' ORDER BY valor ASC LIMIT 5");

    $items = array();

    while($row = $pesquisapacientes->fetch_assoc()){
        array_push($items, $row["valor"]);
    }

    echo json_encode($items);
}else{
    echo "[]";
}


?>