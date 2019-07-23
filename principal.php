<?php

require ("parts/functional/checklogin.php");
require ("functions.php");
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
                <div class="container row">
                    <div class="col-sm-12 col-md-9 mb-5">
                        <div class="row">
                            <h1>Olá <?=get_info_perfil($idusuario, "nome")?>
                            <span class="d-block small font-weight-light font-italic"><?=get_info_perfil($idusuario, "funcao")?></span>
                            </h1>
                            <ul id="ulnav" class="col-12">                        
                                <?php
                                if(isFuncao($idusuario, "dentista")){ ?>
                                <li class="mb-5"><a href="iniciar-atendimento"><i class="far fa-play-circle"></i> Iniciar Atendimento</a></li>
                                <li><a href="meus-atendimentos"><i class="far fa-list-alt"></i> Meus atendimentos</a></li>
                                <?php }else if(isFuncao($idusuario, "administrador")){ 
                                    if(num_dentistas()[1] > 0){ ?>
                                    <li><a href="validacao-cadastro"><i class="fas fa-clipboard-check"></i> Você tem <?=num_dentistas()[1]?> cadastro(s) pendentes para validar!</a></li>
                                    <?php }?>
                                <li><a href="perfil"><i class="far fa-user"></i> Meus dados cadastrais</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                        
                        <!-- Relatórios e gráficos para administrador -->
                        <div class="row">
                            <?php if(isFuncao($idusuario, "administrador")){ ?>
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

                            $meses_mostrados = array();
                            // echo strtotime("now");
                            // echo "<br>";
                            // echo strtotime("+1 month");      
                            for ($i=0; $i < 5; $i++) { 
                                $mes = date('m', strtotime("-{$i} months"));
                                array_push($meses_mostrados, $mes);
                            }
                            // print_r($meses_mostrados);
                            sort($meses_mostrados);

                            $labels = array();
                            $valor_esperado = array();
                            $valor_recebido = array();
                            // $valor_repassado = array(); 

                            foreach ($meses_mostrados as $mes) {
                                $ano = date('Y');
                                // echo $ano;
                                array_push($labels, $meses[intval($mes)]);
                                $s_data = $mes.'-'.$ano;
                                // echo $s_data;

                                // Pesquisa valores esperados
                                $valor_esperado_q = $mydb->query("SELECT SUM(valor) FROM guias WHERE DATE_FORMAT(datahora, '%m-%Y') = '{$s_data}'");
                                foreach( $valor_esperado_q as $valor ){
                                    array_push($valor_esperado, $valor["SUM(valor)"]);
                                }

                                // Pesquisa valores recebidos
                                $valor_recebido_q = $mydb->query("SELECT SUM(valor_pago) FROM guias WHERE DATE_FORMAT(datahora, '%m-%Y') = '{$s_data}'");
                                foreach( $valor_recebido_q as $valor ){
                                    array_push($valor_recebido, $valor["SUM(valor_pago)"]);
                                }
                            }

                            // print_r($valor_esperado);
                            // print_r($valor_recebido);


                            

                            // Separa em data de 

                            
                            ?>
                            <div class="col-md-12 mb-5">
                            <h2 class="mt-4">Gráfico de valores dos últimos 5 meses</h2>
                            <canvas id="myChart" width="400" height="200"></canvas>
                            <script>
                            var ctx = $('#myChart');
                            var myChart = new Chart(ctx, {
                                type: 'line',
                                data: {
                                    labels: <?=json_encode($labels)?>,
                                    datasets: [{
                                        label: 'Valor esperado',
                                        data: <?=json_encode($valor_esperado)?>,
                                        backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                        borderColor: '#690704',
                                        borderWidth: 2
                                    }, {
                                        label: 'Valor recebido',
                                        data: <?=json_encode($valor_recebido)?>,
                                        backgroundColor: 'rgba(50, 219, 140, 0.2)',
                                        borderColor: '#30ad71',
                                        borderWidth: 2
                                    }]
                                },
                                options: {
                                    scales: {
                                        yAxes: [{
                                            ticks: {
                                                beginAtZero: true
                                            }
                                        }]
                                    }
                                }
                            });
                            </script>
                                Em breve gráfico adicional de Atendimentos Realizados
                            </div>
                            <?php } ?>
                        </div>

                    </div>
                    <?php if(isFuncao($idusuario, "administrador")){ ?>
                        <div class="col-sm-12 col-md-3 mb-5">
                            Em breve uma lista das 5 últimas guias pagas
                        </div>
                    <?php } ?>
                </div>
                <?php if(isFuncao($idusuario, "atendente")){ ?>
                        <script>
                            // window.location.href = "guia-recebimento";
                        </script>
                    <?php } ?>
                <?php
                include "parts/structure/footer.php";
                ?>
            </div>
        </div>            
    </div>        
</div>
</body>