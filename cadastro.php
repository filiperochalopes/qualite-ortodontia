<?php
require("config-db.php");
require("config-globals.php");
include "parts/structure/head.php";
?>  
    <?php
    $get_erro = isset($_GET["erro"]) ? "\"".$_GET["erro"]."\"" : "\"\"";
    $get_aviso = isset($_GET["aviso"]) ? "\"".$_GET["aviso"]."\"" : "\"\"";
    ?>
    <script>
      get_erro = <?=$get_erro?> ;
      get_aviso = <?=$get_aviso?>
    </script>

  <body class="text-center" id="smallpage">
    <?php
      include "parts/structure/body.php";
    ?>
    <!-- <form class="form-cadastro" id="form-cadastro" method="post" action="parts/functional/usuarios-novo.php"> -->
    <form class="form-cadastro" id="form-cadastro">
      <img class="mb-4" src="img/logo.png" alt="" height="72">
      <h5 class="mb-3 text-left">Você é dentista? Cadastre-se</h5>
      <fieldset></fieldset>
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

      <div class="container text-left mb-3 mt-4">
        <a href="nova-senha" class="small d-block">Esqueci a senha</a>
        <a href="./" id="naocadastrado" class="small">Já sou cadastrado. Fazer login.</a>
      </div>      
    </form>
    <footer>
      <p class="pb-3 text-muted small"><a target="_blank" href="https://filipelopes.me">Filipe Lopes</a> &copy; 2018</p>
    </footer>
  </body>
</html>
