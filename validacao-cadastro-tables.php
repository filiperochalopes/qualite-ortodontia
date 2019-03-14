<?php 

require ("parts/functional/checklogin.php");
require ("functions.php");
require ("config-db.php");

if(num_dentistas()[1] > 0){ ?>
<h3>Pendentes de autorização <span class="box-sm"><?=num_dentistas()[1]?></span></h3>
<table id="table-usuarios-pendentes" class="table-responsive table-sm simple mb-5">
    <thead>
        <tr>
            <th>Nome do dentista</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <tr class="space"><td></td><td></td><td></td></tr>
        <?php
        $pesquisadentistas = $mydb->query("SELECT * FROM perfis WHERE funcao = 'dentista' ");
        $num_naovalidados = 0;
    
        while($row = $pesquisadentistas->fetch_assoc()){
            $usuario_id = $row["usuario"];
            // echo $usuario_id;
            $pesquisavalidacao = $mydb->query("SELECT * FROM usuarios WHERE id = $usuario_id AND validacao = 0 AND b_del = 0");
            if($pesquisavalidacao->num_rows){
                echo "<tr><td>".$row["nome"]."</td>
                <td>".$row["cpf"]."</td>
                <td>".$row["email"]."</td>
                <td>
                    <button class='btn opcoes aceitar btn-sm' data-id-usuario='".$row["usuario"]."' data-opcao='1'>Aceitar</button>
                    <button class='btn opcoes rejeitar btn-sm' data-id-usuario='".$row["usuario"]."' data-opcao='0'>Rejeitar</button>
                </td></tr>";
            }
        }
        ?>
    </tbody>
</table>
<?php } ?>

<h3>Lista de cadastros</h3>
<table id="table-usuarios" class="table-responsive table-sm simple mb-5">
    <thead>
        <tr>
            <th>Nome do dentista</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <tr class="space"><td></td><td></td><td></td></tr>
        <?php
        $pesquisadentistas = $mydb->query("SELECT * FROM perfis WHERE funcao = 'dentista' ");
        $num_naovalidados = 0;
    
        while($row = $pesquisadentistas->fetch_assoc()){
            $usuario_id = $row["usuario"];
            // echo $usuario_id;
            $pesquisavalidacao = $mydb->query("SELECT * FROM usuarios WHERE id = $usuario_id AND validacao = 1 AND b_del = 0");
            if($pesquisavalidacao->num_rows){
                echo "<tr><td>".$row["nome"]."</td>
                <td>".$row["cpf"]."</td>
                <td>".$row["email"]."</td>
                <td>
                    <button class='btn opcoes rejeitar btn-sm' data-id-usuario='".$row["usuario"]."' data-opcao='0'>Rejeitar</button>
                </td></tr>";
            }
        }
        ?>
    </tbody>
</table>

<h3>Cadastros rejeitados</h3>
<table id="table-usuarios-rejeitados" class="table-responsive table-sm simple mb-5">
    <thead>
        <tr>
            <th>Nome do dentista</th>
            <th>CPF</th>
            <th>Email</th>
            <th>Opções</th>
        </tr>
    </thead>
    <tbody>
        <tr class="space"><td></td><td></td><td></td></tr>
        <?php
        $pesquisadentistas = $mydb->query("SELECT * FROM perfis WHERE funcao = 'dentista' ");
        $num_naovalidados = 0;
    
        while($row = $pesquisadentistas->fetch_assoc()){
            $usuario_id = $row["usuario"];
            // echo $usuario_id;
            $pesquisavalidacao = $mydb->query("SELECT * FROM usuarios WHERE id = $usuario_id AND b_del = 1 ");
            if($pesquisavalidacao->num_rows){
                echo "<tr><td>".$row["nome"]."</td>
                <td>".$row["cpf"]."</td>
                <td>".$row["email"]."</td>
                <td>
                    <button class='btn opcoes aceitar btn-sm' data-id-usuario='".$row["usuario"]."' data-opcao='1'>Recuperar</button>
                </td></tr>";
            }
        }
        ?>
    </tbody>
</table>