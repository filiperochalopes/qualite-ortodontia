<?php
include "parts/structure/head.php";
?>

  <body class="text-center" id="smallpage">
    <?php
    include "parts/structure/body.php"
    ?>
    <form class="form-signin" method="post" action="parts/functional/login.php">
      <img class="mb-4" src="img/logo.png" alt="" height="72">
      <h2><span class="oi oi-warning"></span> Permissão Negada</h2>
      <p class="container">Você não tem permissão para acessar essa página.</p>
      <div class="container text-left mb-3 mt-4">
        <a href="./principal" class="small">Ir para página principal</a>
      </div>      
      <footer>
        <p class="pb-3 text-muted small"><a target="_blank" href="https://filipelopes.me">Filipe Lopes</a> &copy; 2018</p>
      </footer>
    </form>
  </body>
</html>
