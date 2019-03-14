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
                <h1 class="pageTitle">Configurações</h1>
                <section>
                    <header class="row">
                        <h2 class="col-12 pageSubtitle"><span class="oi oi-lock-locked"></span> Segurança</h2>
                    </header>
                    <div class="row">
                        <section class="col-lg-4 col-md-6 mb-5">
                        <div class="container">
                            <h3>Alterar senha</h3>
                            <form id="form-novasenha" method="post">
                                <input class="form-control top" type="password" name="antigasenha" id="antigasenha" placeholder="Senha atual" required/>
                                <input class="form-control middle" type="password" name="novasenha" id="novasenha" placeholder="Nova senha" required/>
                                <input class="form-control bottom" type="password" name="confirmsenha" id="confirmsenha" placeholder="Nova senha novamente" required/>
                                <button type="submit" class="btn btn-block btn-primary mt-3">Alterar</button>
                            </form>
                        </div>
                        </section>
                        <section class="col-lg-4 col-md-6 mb-5">
                        <div class="container">
                            <h3>Email de recuperação</h3>
                            <div class="descricao">Email para recuperação de dados.</div>
                            <input class="form-control top" type="text" name="email" id="email" placeholder="Usuário" required/>
                            <button type="submit" id="configemail-bt"  class="btn btn-block btn-primary mt-3">Alterar</button>
                        </div>
                        </section>
                    </div>
                </section>
        </div>
        <?php
        include "parts/structure/footer.php";
        ?> 
        <script>
            $(document).ready( function(){
                
                $("#email").val("<?php echo $_SESSION["email"]; ?>").attr("data-empty", false);
                
            });
        </script>
                </div>
            </div>
        </div>            
    </div>        
</div>
</body>