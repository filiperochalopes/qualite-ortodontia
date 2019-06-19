<?php

require ("parts/functional/checklogin.php");
require ("functions.php");

// Verifica permissao
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
                    <h1><i class="far fa-list-alt"></i> Atendimentos</h1>
                    <p class="mb-4">Lista de todos os atendimentos com respectivos <i>status</i> de pagamento por parte do convênio ou particular (breve) e repasses para os profissionais</p>
                    <select id="filtro_atendimentos_mes_" name="filtro_atendimentos_mes" class="form-control middle"> 
                        <option value="0">Selecione um mês</option>
                        <option value='todos'><strong>Ver todos</strong></option>
                        <option disabled="disabled">----</option>   
                        <?php
                        $pesquisaconvenios = $mydb->query("SELECT DISTINCT EXTRACT(YEAR_MONTH FROM datahora) FROM guias ORDER BY EXTRACT(YEAR_MONTH FROM datahora) DESC
                        ");
                        while($row = $pesquisaconvenios->fetch_assoc()){
                            echo "<option value='".converter_year_month($row["EXTRACT(YEAR_MONTH FROM datahora)"])[1]."'>".converter_year_month($row["EXTRACT(YEAR_MONTH FROM datahora)"])[0]."</option>";
                        }
                        ?>  
                    </select><br/>

                    <!-- Filtro de dentista -->

                    <div class="input-group mb-4">
                        <input type="text" class="form-control middle hint-input" type="text" name="filtro_relatorio_guias_dentista" id="filtro_relatorio_guias_dentista" placeholder="Nome do dentista" autocomplete="off" autofocus >
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="button" id="filtrar_atendimentos">Pesquisar</button>
                        </div>
                    </div>
                    
                    <div class="form-control middle hint" id="dentistas-hint" data-input-hint="filtro_relatorio_guias_dentista">
                        <ul>
                        </ul>
                    </div>

                    <?php
                    
                    $mes = isset($_GET["mes"]) ? $_GET["mes"] : null;
                    $dentista = isset($_GET["dentista"]) ? $_GET["dentista"] : null;
                    
                    if($mes || $dentista){

                    ?>

                    <input type="hidden" name="dentista_id" id="dentista_id" />
                    
                    
                    <form action="ajax/relatorio-guias-pagas-pdf.php" method="post">
                        <input type="hidden" name="mes" value="<?=$mes?>"/>
                        <input type="hidden" name="dentista" id="dentista" value="<?=$dentista?>"/>
                        <button type="submit" class="btn btn-block btn-primary mt-3 mb-5" id="relatorio_guias_pdf">Gerar relatório da busca em PDF</button>
                    </form>

                    <?php } ?>
                    
                    <!-- OLD TABLE -->
                    
                    <!-- <table class="table-responsive table-sm simple">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Profissional</th>
                                <th>Atendimento</th>
                                <th>Convênio</th>
                                <th>Valor esperado</th>
                                <th>Pagamento</th>
                                <th>Repasse</th>
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
                    
                    if(isset($_GET["mes"])){
                        // Filtrar
                        $mes = $_GET["mes"];
                        if($mes != 0 && $dentista != ""){
                            $searchStr = "datahora LIKE '".$mes."%' AND dentista = '$dentista' ";
                        }else if($mes != 0){
                            $searchStr = "datahora LIKE '".$mes."%' ";
                        }else{
                            $searchStr = "dentista = '$dentista' ";
                        }
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE $searchStr ORDER BY datahora DESC");
                    }else{
                        $pesquisaguias = $mydb->query("SELECT * FROM guias ORDER BY datahora DESC");
                    }

                    while($row = $pesquisaguias->fetch_assoc()){
                        $datetime = new DateTime($row["datahora"]);
                        $mes_novo = $datetime->format('m');
                        $ano_novo = $datetime->format('Y');

                        console_log($datetime);
                        console_log($mes_novo);
                        console_log($ano_novo);
                        console_log($meses[intval($mes_novo)]);

                        if($mes_novo != $mes_atual){
                            echo "<tr><td colspan='7' class='month'>".$meses[intval($mes_novo)]." de ".$ano_novo."</td></tr>";
                        }

                        echo "<tr>
                        <td>".$row["numero"]."</td>
                        <td>".get_object_perfil($row["dentista"])->nome."</td>
                        <td>".get_atendimento($row["atendimento"])[0]."</td>
                        <td>".get_convenio($row["convenio"])."</td>
                        <td>".$row["valor"]."</td>
                        <td class='pagamento bol_".$row["b_pago"]."'>".$row["valor_pago"]."</td>";
                        if($row["b_pago"]){
                            echo "<td class='pagamento bol_".$row["b_repasse"]."'>
                            ( R$ ".calc_repasse($row["id"])." ) ";
                            if(!$row["b_repasse"]){
                                echo "<input type='checkbox' class='repassar' data-id='".$row["id"]."' data-valor='".calc_repasse($row["id"])."'/> <span>Marcar como repassado</span>";
                            }
                            echo "</td>";
                        }else{
                            echo "<td></td>";
                        }
                        echo "<td class='datahora'>".$row["datahora"]."$mes_novo</td>
                            </tr>";
                        
                        $mes_atual = $datetime->format('m');
                    }
                    ?>
                    </tbody>
                    </table> -->

                    <!-- NOVO DATATABLE -->

                    <table class="table-responsive table-sm simple datatable">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Profissional</th>
                                <th>Atendimento</th>
                                <th>Convênio</th>
                                <th>Valor esperado</th>
                                <th>Pagamento</th>
                                <th>Repasse</th>
                                <th>Data e hora</th>
                            </tr>
                        </thead>
                        <tbody>
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
                    
                    if(isset($_GET["mes"])){
                        // Filtrar
                        $mes = $_GET["mes"];
                        if($mes != 0 && $dentista != ""){
                            $searchStr = "datahora LIKE '".$mes."%' AND dentista = '$dentista' ";
                        }else if($mes != 0){
                            $searchStr = "datahora LIKE '".$mes."%' ";
                        }else{
                            $searchStr = "dentista = '$dentista' ";
                        }
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE $searchStr ORDER BY datahora DESC");
                    }else{
                        $pesquisaguias = $mydb->query("SELECT * FROM guias ORDER BY datahora DESC");
                    }

                    while($row = $pesquisaguias->fetch_assoc()){
                        $datetime = new DateTime($row["datahora"]);
                        $mes_novo = $datetime->format('m');
                        $ano_novo = $datetime->format('Y');
                        $mostrar_data = $datetime->format('d/m/Y H:i:s');

                        console_log($datetime);
                        console_log($mes_novo);
                        console_log($ano_novo);
                        console_log($meses[intval($mes_novo)]);

                        // if($mes_novo != $mes_atual){
                        //     echo "<tr><td colspan='8' class='month'>".$meses[intval($mes_novo)]." de ".$ano_novo."</td></tr>";
                        // }

                        echo "<tr>
                        <td>".$row["numero"]."</td>
                        <td>".get_object_perfil($row["dentista"])->nome."</td>
                        <td>".get_atendimento($row["atendimento"])[0]."</td>
                        <td>".get_convenio($row["convenio"])."</td>
                        <td>".$row["valor"]."</td>
                        <td class='pagamento bol_".$row["b_pago"]."'>".$row["valor_pago"]."</td>";
                        if($row["b_pago"]){
                            echo "<td class='pagamento bol_".$row["b_repasse"]."'>
                            ( R$ ".calc_repasse($row["id"])." ) ";
                            if(!$row["b_repasse"]){
                                echo "<input type='checkbox' class='repassar' data-id='".$row["id"]."' data-valor='".calc_repasse($row["id"])."'/> <span>Marcar como repassado</span>";
                            }
                            echo "</td>";
                        }else{
                            echo "<td></td>";
                        }
                        echo "<td class='datahora'>".$mostrar_data."</td>
                        </tr>";
                        
                        $mes_atual = $datetime->format('m');
                    }
                    ?>
                    
                    </tbody>
                    </table>
                </div>

                <script>
                    $(document).ready( function(){
                        $('.datatable').DataTable( {
                            "pageLength": 25,
                            // responsive: true,
                            "language": {
                                "search": "Pesquisar:",
                                "zeroRecords": "Não há informações para serem mostradas",
                                "processing": "Carregando...",
                                "info": "Mostrando _START_ a _END_ de _TOTAL_ linhas",
                                "lengthMenu": "Mostrar _MENU_ linhas por vez",
                                "paginate": {
                                    "first":      "Primeiro",
                                    "last":       "Último",
                                    "next":       "Próximo",
                                    "previous":   "Anterior"
                                },
                            }
                        } );
                    })
                </script>
                </div>
                <?php
                include "parts/structure/footer.php";
                ?>
            </div>
        </div>            
    </div>        
</div>
</body>