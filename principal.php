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
                        <h1>Olá <?=get_info_perfil($idusuario, "nome")?>
                        <span class="d-block small font-weight-light font-italic"><?=get_info_perfil($idusuario, "funcao")?></span>
                        </h1>
                        <ul id="ulnav" class="col-12">                        
                            <?php
                            if(isFuncao($idusuario, "dentista")){ ?>
                            <li class="mb-5"><a href="iniciar-atendimento"><span class="oi oi-play-circle"></span> Iniciar Atendimento</a></li>
                            <li><a href="meus-atendimentos"><span class="oi oi-list"></span> Meus atendimentos</a></li>
                            <?php }else if(isFuncao($idusuario, "administrador")){ 
                                if(num_dentistas()[1] > 0){ ?>
                                <li><a href="validacao-cadastro"><span class="oi oi-task"></span> Você tem <?=num_dentistas()[1]?> cadastro(s) pendentes para validar!</a></li>
                                <?php }?>
                            <li><a href="perfil"><span class="oi oi-person"></span> Meus dados cadastrais</a></li>
                            <?php } ?>
                        </ul>
                    </div>
                    <?php if(isFuncao($idusuario, "administrador")){ ?>
                        <div class="col-sm-12 col-md-3 mb-5">
                            menu
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