<?php

require ("parts/functional/checklogin.php");
require ("functions.php");
require ("config-db.php");

// Verifica permissao
$permissao = "iniciar-atendimento";
require ("parts/functional/checkpermissao.php");

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
                    <h1>Iniciar Atendimento</h1>
                    <p class="mb-4">Selecione o o paciente que deseja iniciar atendimento</p>

                    <ul id="selecionar_guia" class="list-group mb-4">
                        <?php
                        $pesquisaguias = $mydb->query("SELECT * FROM guias WHERE dentista = '$idusuario' AND status = 'aguardando atendimento'");
                        while($row = $pesquisaguias->fetch_assoc()){
                            echo "<li class=\"list-group-item\" data-guia='".$row["numero"]."'>".$row["numero"]." - ".$row["paciente"]." - <span class='status_atendimento'>".$row["status"]."</span></li>";
                        }
                        ?>
                    </ul>

                    <p class="mb-4">Ou preencha manualmente com o número da guia</p>
                    
                    <form id="form-iniciar-atendimento" method="post">
                        <input class="form-control top" type="number" name="guia" id="guia" placeholder="Número da guia" autocomplete="off" required/>
                                       
                        <button type="button" class="btn btn-block btn-primary mt-4" id="verificar_informacoes">Verificar informações</button>

                        <section id="iniciar_atendimento_sec" class="pt-4">
                            <div>
                                <strong>Nome do paciente</strong> <span id="nomepaciente"></span> <br/>
                                <strong>Tipo de atendimento</strong> <span id="atendimento"></span> <br/>
                                <strong>Descrição do procedimento</strong> <span id="descricao"></span> <br/>
                                <strong>Valor esperado</strong> R$ <span id="valor"></span> <br/>
                            </div>
                            <button type="submit" class="btn btn-block btn-primary mt-4">Iniciar Atendimento</button>
                        </section>
                    </form>
                </div>
                <?php
                include "parts/structure/footer.php";
                ?>
            </div>
        </div>            
    </div>        
</div>
</body>