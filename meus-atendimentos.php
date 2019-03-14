<?php

require ("parts/functional/checklogin.php");
require ("functions.php");

//Verifica permissao
$permissao = "meus-atendimentos";
require ("parts/functional/checkpermissao.php");

require ("config-db.php");

include "parts/structure/head.php";
?>
<body>
    
    <?php
    include "parts/structure/body.php";
    include "parts/structure/header.php";
    include "parts/structure/nav.php";

    $idusuario = $_SESSION["id_usuario"];
    ?>
    
<div class="page">    
    <div class="container-fluid">
        <div class="row">
            <?php
            include "parts/structure/aside.php";
            ?>
            <div class="col-sm-10 col-md-9 pt-5">
                <div class="container">
                    <h1>Meus atendimentos</h1>
                    <p class="mb-4">Digite o número da guia e demais informações do campo abaixo para iniciar o atendimento</p>
                    <table class="table-responsive table-sm simple">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Paciente</th>
                                <th>Atendimento</th>
                                <th>Convênio</th>
                                <th>Descrição</th>
                                <th>Pagamento</th>
                                <th>Data e hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="space"><td></td><td></td><td></td><td></td><td></td><td></td><td></td></tr>
                    <?php
                    $meses = array(
                        "", "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Março",
                        "Maio",
                        "Junho",
                        "Julho",
                        "Agosto",
                        "Setembro",
                        "Outubro",
                        "Novembro",
                        "Dezembro"
                    );

                    $mes_atual = 0; //reset
                    
                    $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE dentista = '$idusuario' ORDER BY datahora DESC");
                    while($row = $pesquisaguias->fetch_assoc()){
                        $datetime = new DateTime($row["datahora"]);
                        $mes_novo = $datetime->format('m');
                        $ano_novo = $datetime->format('Y');

                        if($mes_novo != $mes_atual){
                            echo "<tr><td colspan='7' class='month'>".$meses[$mes_novo]." de ".$ano_novo."</td></tr>";
                        }

                        echo "<tr>
                        <td>".$row["numero"]."</td>
                        <td>".$row["paciente"]."</td>
                        <td>".get_atendimento($row["atendimento"])[0]."</td>
                        <td>".get_convenio($row["convenio"])."</td>
                        <td class='descricao'><div>".$row["descricao"]."</div></td>
                        <td class='pagamento bol_".$row["b_pago"]."'></td>
                        <td class='datahora'>".$row["datahora"]."$mes_novo</td>
                        </tr>";
                        
                        $mes_atual = $datetime->format('m');
                    }
                    ?>
                    </tbody>
                    </table>
                </div>
                <?php
                include "parts/structure/footer.php";
                ?>
            </div>
        </div>            
    </div>        
</div>
</body>