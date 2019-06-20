<?php

require ("parts/functional/checklogin.php");
require ("functions.php");
require ("config-db.php");

// Verifica permissao
$permissao = "cadastro-convenios";
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
                    <h1>Cadastrar novo convênio</h1>

                    <form class="form-convenio" id="form-convenio">
                        <input type="text" id="nome" name="nome" class="form-control mb-4" placeholder="Nome do convênio" required autofocus />

                        <button class="btn btn-lg btn-primary btn-block" type="submit">Cadastrar</button>    
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
