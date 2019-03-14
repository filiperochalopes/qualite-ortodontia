<?php
include "parts/structure/head.php";
?>

  <body class="text-center" id="smallpage">
    <?php
    include "parts/structure/body.php";
    $get_erro = isset($_GET["erro"]) ? "\"".$_GET["erro"]."\"" : "\"\"";
    $get_aviso = isset($_GET["aviso"]) ? "\"".$_GET["aviso"]."\"" : "\"\"";
    ?>
    <script>
      get_erro = <?=$get_erro?>;
      get_aviso = <?=$get_erro?>
    </script>
    <form class="form-signin" method="post" action="parts/functional/login.php">
      <img class="mb-4" src="img/logo.png" alt="" height="72">
      <input type="text" id="email" name="email" class="form-control" placeholder="Digite seu email" required autofocus>
      <button class="btn btn-lg btn-primary btn-block" id="esqueceusenha" type="submit">Requisitar nova senha</button>
      <div class="container text-left mb-3 mt-4">
        <a href="./" class="small d-block">Fazer Login</a>
        <a href="cadastro" id="naocadastrado" class="small">Não sou cadastrado</a>
      </div>      
      <footer>
        <p class="pb-3 text-muted small"><a target="_blank" href="https://filipelopes.me">Filipe Lopes</a> &copy; 2018</p>
      </footer>
    </form>
  </body>
</html>
