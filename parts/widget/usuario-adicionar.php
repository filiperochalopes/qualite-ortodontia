<section>
    <h3><i class="fas fa-plus-square"></i> Adicionar novo cliente</h3>
    <?php
        $restantes = get_planoatual()[2] - num_clientes($_SESSION["lojista"]);
    ?>
    <?php
        if(!checkClientes()){
    ?>
    <p>Você tem <?=num_clientes($_SESSION["lojista"])?> clientes</p>
    <p>Você pode adicionar mais <?=$restantes?> clientes</p>
    <p>Você pode adicionar mais clientes</p>
    <form id="form-clientes" method="post">
        <fieldset>
            <legend>Informações pessoais</legend>
            <div class="placeholder inline">
                <input type="text" name="telefone" id="telefone" class="celular" required>
                <label for="telefone">Telefone</label>
            </div>
        </fieldset>                        
        <button type="submit" class="simple">Criar</button>
    </form>
    <?php
        }else{
            echo "Você chegou ao seu limite de clientes cadastrados, <a href='planos'>contrate um de nossos planos</a> para continuar aumentando seu alcance!";
        }
    ?>
</section>