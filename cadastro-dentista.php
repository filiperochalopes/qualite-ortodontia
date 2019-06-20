<?php

require ("parts/functional/checklogin.php");
require ("functions.php");
require ("config-db.php");

// Verifica permissao
$permissao = "cadastro-dentista";
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
                    <h1>Cadastrar novo dentista</h1>

                    <form class="form-cadastro" id="form-cadastro-interno">
                        <input type="text" id="nome" name="nome" class="form-control top" placeholder="Nome" required autofocus />
                        <input type="text" id="cpf" name="cpf" class="cpf form-control middle" placeholder="CPF" required autofocus />
                        <input type="email" id="email" name="email" class="form-control middle" placeholder="Email" required />
                        <input type="text" id="celular" name="celular" class="celular form-control bottom mb-4" placeholder="Celular" required />

                        <input type="password" id="senha" name="senha" class="form-control top" placeholder="Digite uma senha" required />
                        <input type="password" id="confirmsenha" name="confirmsenha" class="form-control mb-4 bottom" placeholder="Repita sua senha">

                        <input type="text" id="auto_cep" name="cep" class="form-control top" placeholder="CEP" required />
                        <input type="text" id="auto_rua" name="rua" class="form-control middle" placeholder="Rua" required />
                        <input type="number" id="numero" name="numero" class="form-control middle" placeholder="Número" required />
                        <input type="text" id="complemento" name="complemento" class="form-control middle" placeholder="Complemento"/>
                        <input type="text" id="auto_bairro" name="bairro" class="form-control middle" placeholder="Bairro" required />
                        <input type="text" id="auto_cidade" name="cidade" class="form-control middle" placeholder="Cidade" required />
                        <input type="text" id="auto_estado" name="estado" class="form-control bottom mb-4" placeholder="Estado" required />

                        <input type="number" id="cro" name="cro" class="form-control top" placeholder="CRO" required />
                        <input type="text" id="especialidade" name="especialidade" class="form-control mb-4 bottom" placeholder="Especialidade">
                            
                        </select>

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
