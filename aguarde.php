<?php
include "parts/structure/head.php";
?>

  <body class="text-center" id="smallpage">
    <?php
    include "parts/structure/body.php"
    ?>
    <form class="form-signin" method="post" action="parts/functional/login.php">
      <img class="mb-4" src="img/logo.png" alt="" height="72">
      <h2>Você foi cadastrado</h2>
      <p class="container"><span class="oi oi-clock"></span> Aguarde a moderação do ADMNISTRADOR do sistema para poder acessar o sistema.</p>
      <div class="container text-left mb-3 mt-4">
        <a href="./" class="small">Retornar para Login</a>
      </div>      
      <footer>
        <p class="pb-3 text-muted small"><a target="_blank" href="https://filipelopes.me">Filipe Lopes</a> &copy; 2018</p>
      </footer>
    </form>
  </body>
</html>
