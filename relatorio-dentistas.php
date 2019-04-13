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
                    <h1>Relatório de dentistas</h1>
                    <p class="mb-4">Relatório por nome do dentista: lista de atendimento, data, valor do plano, valor repassado.</p>
                    
                    <div class="input-group">
                        <input type="text" class="form-control middle hint-input" type="text" name="filtro_relatorio_guias_dentista" id="filtro_relatorio_guias_dentista" placeholder="Nome do dentista" autocomplete="off" autofocus >
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="filtro_relatorio_guias_dentista_bt">Pesquisar</button>
                        </div>
                    </div>
                    
                    <div class="form-control middle hint" id="dentistas-hint" data-input-hint="filtro_relatorio_guias_dentista">
                        <ul>
                        </ul>
                    </div>                    
                    
                    <form action="ajax/relatorio-dentistas-pdf.php" method="post">
                        <input type="hidden" name="dentista" id="dentista_id" value="<?=$_GET["filtro"]?>"/>

                        <?php
                        if(isset($_GET["filtro"])){
                        ?>

                        <button type="submit" class="btn btn-block btn-primary mt-3 mb-5" id="relatorio_dentistas_pdf">Gerar relatório de <?=get_object_perfil($_GET["filtro"])->nome?> em PDF</button>

                        <?php
                        }
                        ?>
                    </form>

                    <div class="mb-4"></div>
                    <table class="table-responsive table-sm simple">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Profissional</th>
                                <th>Especialidade</th>
                                <th>Valor do plano</th>
                                <th>Valor repassado</th>
                                <th>Data e hora</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="space"><td></td><td></td><td></td><td></td></tr>
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
                    
                    $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE b_pago = 0 ORDER BY datahora DESC");

                    if(isset($_GET["filtro"])){
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE dentista = ".$_GET['filtro']." AND b_pago = 0 ORDER BY datahora DESC");
                    }else{
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE b_pago = 0 ORDER BY datahora DESC");
                    }

                    while($row = $pesquisaguias->fetch_assoc()){
                        $datetime = new DateTime($row["datahora"]);
                        $mes_novo = $datetime->format('m');
                        $ano_novo = $datetime->format('Y');

                        if($mes_novo != $mes_atual){
                            echo "<tr><td colspan='7' class='month'>".$meses[$mes_novo]." de ".$ano_novo."</td></tr>";
                        }

                        echo "<tr>
                        <td>".$row["numero"]."</td>
                        <td>".get_object_perfil($row["dentista"])->nome."</td>
                        <td>".get_atendimento($row["atendimento"])[0]."</td>
                        <td class='pagamento bol_".$row["b_pago"]."'></td>
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