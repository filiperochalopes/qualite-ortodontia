<?php

require ("parts/functional/checklogin.php");
require ("functions.php");

//Verifica permissao
$permissao = "atendimentos";
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
                    <h1>Relatório de Guias não pagas</h1>
                    <p>Relatório de guias ainda não pagas por planos<br/>
                    Selecione um dos convênios abaixo para baixar o relatório de guias não pagas</p>
                    <select id="filtro_relatorio_guias_convenio" name="filtro_relatorio_guias_convenio" class="form-control middle">
                        <option value="0">Selecione um convênio</option>
                        <option value='todos'><strong>Ver todos</strong></option>
                        <option disabled="disabled">----</option>
                        <?php
                        $pesquisaconvenios = $mydb->query("SELECT * FROM convenios ORDER BY convenio ASC
                        ");
                        while($row = $pesquisaconvenios->fetch_assoc()){
                            echo "<option value='".$row["id"]."'>".$row["convenio"]."</option>";
                        }
                        ?>
                    </select><br/>
                    <?php
                    if(isset($_GET["filtro"])){
                    ?>
                    
                    <form action="ajax/relatorio-guias-pdf.php" method="post">
                        <input type="hidden" name="convenio" value="<?=$_GET["filtro"]?>"/>
                        <button type="submit" class="btn btn-block btn-primary mt-3 mb-5" id="relatorio_guias_pdf">Gerar relatório de <?=get_convenio($_GET["filtro"])?> em PDF</button>
                    </form>

                    <?php
                    }
                    ?>

                    <table class="table-responsive table-sm simple">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Profissional</th>
                                <th>Convênio</th>
                                <th>Pagamento</th>
                                <th>Data e hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="space"><td></td><td></td><td></td><td></td><td></td></tr>
                    <?php
                    $meses = array(
                        "", "Janeiro",
                        "Fevereiro",
                        "Março",
                        "Abril",
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
                    
                    if(isset($_GET["filtro"])){
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE convenio = ".$_GET['filtro']." AND b_pago = 0 ORDER BY datahora DESC");
                    }else{
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE b_pago = 0 ORDER BY datahora DESC");
                    }

                    while($row = $pesquisaguias->fetch_assoc()){
                        $datetime = new DateTime($row["datahora"]);
                        $mes_novo = $datetime->format('m');
                        $ano_novo = $datetime->format('Y');

                        if($mes_novo != $mes_atual){
                            echo "<tr><td colspan='7' class='month'>".$meses[intval($mes_novo)]." de ".$ano_novo."</td></tr>";
                        }

                        echo "<tr>
                        <td>".$row["numero"]."</td>
                        <td>".get_object_perfil($row["dentista"])->nome."</td>
                        <td>".get_convenio($row["convenio"])."</td>
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