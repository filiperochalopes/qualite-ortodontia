<?php

require("../../config-db.php");

$get_descricao = $_GET["str"];

if($get_descricao != ""){
    $pesquisapacientes = $mydb->query("SELECT descricao FROM guias WHERE descricao LIKE '%$get_descricao%' ORDER BY valor ASC LIMIT 5");

    $items = array();

    while($row = $pesquisapacientes->fetch_assoc()){
        array_push($items, $row["descricao"]);
    }

    echo json_encode($items);
}else{
    echo "[]";
}


?>