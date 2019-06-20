<?php

require ("parts/functional/checklogin.php");
require ("functions.php");
require ("config-db.php");

// Verifica permissao
$permissao = "novo-atendimento";
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
                    <h1>Novo Atendimento</h1>
                    <p class="mb-4">Digite o número da guia e demais informações do campo abaixo para iniciar o atendimento</p>
                    <form id="form-novo-atendimento" method="post">
                        <input class="form-control top" type="number" name="numero" id="numero" placeholder="Número da guia" autocomplete="off" required/>
                        
                        <!-- Campo com hint dentista -->

                        <input type="text" class="form-control middle hint-input" type="text" name="filtro_relatorio_guias_dentista" id="filtro_relatorio_guias_dentista" placeholder="Nome do dentista" autocomplete="off" required>
                        <div class="form-control middle hint" id="dentistas-hint" data-input-hint="filtro_relatorio_guias_dentista">
                            <ul>
                            </ul>
                        </div>

                        <input type="hidden" name="dentista_id" id="dentista_id" required/>

                        <!-- Campo com hint paciente -->

                        <input class="form-control middle hint-input" type="text" name="paciente" id="paciente" placeholder="Nome do paciente" autocomplete="off" required/>
                        <div class="form-control middle hint" id="pacientes-hint" data-input-hint="paciente">
                            <ul>
                            </ul>
                        </div>

                        <!-- Select de modalidade que só abre após colocar dentista para filtrar -->
                        <select id="atendimento" name="atendimento" class="form-control middle" disabled>
                        <option value="0" disabled selected>Selecione uma modalidade de atendimento</option>
   
                        </select>

                        <!-- Select de convênios -->
                        <select id="convenio" name="convenio" class="form-control middle">
                        <option value="0">Selecione um convênio</option>
                        <?php
                        $pesquisaconvenios = $mydb->query("SELECT * FROM convenios ORDER BY convenio ASC
                        ");
                        while($row = $pesquisaconvenios->fetch_assoc()){
                            echo "<option value='".$row["id"]."'>".$row["convenio"]."</option>";
                        }
                        ?>
                        </select>


                        <!-- <input class="form-control middle" type="text" name="nomeconvenio" id="nomeconvenio" placeholder="Nome do convênio"/> -->
                        <input class="form-control middle hint-input" type="number" name="valor" id="valor" step=".01" placeholder="Valor esperado de recebimento" autocomplete="off"/>
                        <div class="form-control middle hint" id="valor-hint" data-input-hint="valor">
                            <ul>
                            </ul>
                        </div>

                        <!-- Descrição do procedimento com hint -->
                        <textarea class="form-control bottom hint-input" type="text" name="descricao" id="descricao" placeholder="Descrição do procedimento" ></textarea>
                        <div class="form-control middle hint" id="descricao-hint" data-input-hint="descricao">
                            <ul>
                            </ul>
                        </div>

                        <button type="submit" class="btn btn-block btn-primary mt-4">Cadastrar Atendimento</button>
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