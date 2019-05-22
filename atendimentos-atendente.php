<?php

require ("parts/functional/checklogin.php");
require ("functions.php");

//Verifica permissao
$permissao = "atendimentos-atendente";
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
                    <h1>Atendimentos</h1>
                    <p class="mb-4">Lista de todos os atendimentos com respectivos <i>status</i> de pagamento por parte do convênio ou particular (breve) e repasses para os profissionais</p>
                    <select id="filtro_atendimentos_mes" name="filtro_atendimentos_mes" class="form-control middle">
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
                    <!-- <table class="table-responsive table-sm simple">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Profissional</th>
                                <th>Paciente</th>
                                <th>Status</th>
                                <th>Edição</th>
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
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE datahora LIKE '".$_GET['filtro']."%' ORDER BY datahora DESC");
                    }else{
                        $pesquisaguias = $mydb->query("SELECT * FROM guias ORDER BY datahora DESC");
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
                        <td>".$row["paciente"]."</td>
                        <td> Status </td>
                        <td> <button class='editar' data-toggle=\"modal\" data-target=\"#exampleModal\" data-guia=\"".$row["numero"]."\">Editar</button> </td>
                        </tr>";
                        
                        $mes_atual = $datetime->format('m');
                    }
                    ?>

                    </tbody>
                    </table> -->


                    <table class="table-responsive table-sm simple datatable">
                        <thead>
                            <tr>
                                <th>Guia</th>
                                <th>Profissional</th>
                                <th>Paciente</th>
                                <th>Status</th>
                                <th>Edição</th>
                                <th>Atendimento</th>
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
                    
                    if(isset($_GET["filtro"])){
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE datahora LIKE '".$_GET['filtro']."%' ORDER BY datahora DESC");
                    }else{
                        $pesquisaguias = $mydb->query("SELECT * FROM guias ORDER BY datahora DESC");
                    }

                    while($row = $pesquisaguias->fetch_assoc()){
                        $datetime = new DateTime($row["datahora"]);
                        $dia_novo = $datetime->format('d');
                        $mes_novo = $datetime->format('m');
                        $ano_novo = $datetime->format('Y');

                        // if($mes_novo != $mes_atual){
                        //     echo "<tr><td colspan='7' class='month'>".$meses[intval($mes_novo)]." de ".$ano_novo."</td></tr>";
                        // }

                        

                        echo "<tr>
                        <td>".$row["numero"]."</td>
                        <td>".get_object_perfil($row["dentista"])->nome."</td>
                        <td>".$row["paciente"]."</td>
                        <td>".get_status_tag($row["status"])."</td>
                        <td> <button class='editar' data-toggle=\"modal\" data-target=\"#exampleModal\" data-guia=\"".$row["numero"]."\">Editar</button> </td>
                        <td>{$dia_novo}/{$mes_novo}/{$ano_novo}</td>
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

                <!-- Modal -->
                <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Editar guia</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div id="modal_body" class="modal-body">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <button data-dismiss="modal" type="button" id="submit_modal" class="btn btn-primary">Salvar Alterações</button>
                        </div>
                        </div>
                    </div>
                </div>

                <?php
                include "parts/structure/footer.php";
                ?>
            </div>
        </div>            
    </div>        
</div>
</body>