<?php

require ("parts/functional/checklogin.php");
require ("functions.php");

//Verifica permissao
$permissao = "guia-recebimento";
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
                    <h1>Recebimento de Guias</h1>
                    <p class="mb-4">Digite abaixo o número da guia e seu respectivo valor inerente</p>
                    <form id="form_guia_recebimento">
                        <input class="form-control top" type="number" name="guia" id="guia" placeholder="Número da guia" autocomplete="off" required/>
                        <input class="form-control bottom " type="number" step="0.01" name="valor" id="valor" placeholder="Valor da guia" autocomplete="off" required/>
                        <button type="submit" id="form_guia_recebimento_bt" class="btn btn-block btn-primary mt-4">Registrar</button>
                    </form>
                        <div id="show_guia_info" class="mt-4">
                            <h4></h4>
                            <p></p>
                        </div>
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