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
                <div class="container">
                    <h1>Cadastros de dentistas</h1>

                    <div id="wrap-validacao-cadastro"></div>

                    <script>
                        $( "#wrap-validacao-cadastro" ).load( "validacao-cadastro-tables.php" );
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