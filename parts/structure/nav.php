<nav class="col-sm-12 col-md-4 col-lg-3">
    <div id="mainlogo" class="link" data-link="principal"></div>
    <ul>
        <li class="link" data-link="principal"><span class="oi oi-home"></span><span class="navitem ml-2">Principal</span></li>

        <?php if(permissao("novo-atendimento")){ ?>
        <li class="link" data-link="novo-atendimento"><span class="oi oi-plus"></span><span class="navitem ml-2">Novo atendimento</span></li>
        <?php } ?>

        <?php if(permissao("iniciar-atendimento")){ ?>
        <li class="link" data-link="iniciar-atendimento"><span class="oi oi-play-circle"></span><span class="navitem ml-2">Iniciar atendimento</span></li>
        <?php } ?>

        <?php if(permissao("meus-atendimentos")){ ?>
        <li class="link" data-link="meus-atendimentos"><span class="oi oi-list"></span><span class="navitem ml-2">Meus atendimentos</span></li>
        <?php } ?>

        <?php if(permissao("validacao-cadastro")){ ?>
        <li class="link" data-link="validacao-cadastro"><span class="oi oi-task"></span><span class="navitem ml-2">Validação de cadastro <span class="box-sm"><?=num_dentistas()[1]?></span></span></li>
        <?php } ?>

        <?php if(permissao("cadastro-dentista")){ ?>
        <li class="link" data-link="cadastro-dentista"><span class="oi oi-plus"></span><span class="navitem ml-2">Cadastro de dentista</span></li>
        <?php } ?>

        <?php if(permissao("cadastro-convenios")){ ?>
        <li class="link" data-link="cadastro-convenios"><span class="oi oi-plus"></span><span class="navitem ml-2">Cadastro de convênios</span></li>
        <?php } ?>

        <?php if(permissao("atendimentos")){ ?>
        <li class="link" data-link="atendimentos"><span class="oi oi-list"></span><span class="navitem ml-2">Atendimentos</span></li>
        <?php } ?>

        <?php if(permissao("atendimentos-atendente")){ ?>
        <li class="link" data-link="atendimentos-atendente"><span class="oi oi-list"></span><span class="navitem ml-2">Atendimentos</span></li>
        <?php } ?>

        <?php if(permissao("guia-recebimento")){ ?>
        <li class="link" data-link="guia-recebimento"><span class="oi oi-plus"></span><span class="navitem ml-2">Recebimento de Guias</span></li>
        <?php } ?>

        <?php if(permissao("guias-pagas")){ ?>
        <li class="link" data-link="guias-pagas"><span class="oi oi-check"></span><span class="navitem ml-2">Ver Guias pagas</span></li>
        <?php } ?>

        <?php if(permissao("relatorio-guias")){ ?>
        <li class="link" data-link="relatorio-guias"><span class="oi oi-graph"></span><span class="navitem ml-2">Relatório [Guias]</span></li>
        <?php } ?>

        <?php if(permissao("relatorio-dentistas")){ ?>
        <li class="link" data-link="relatorio-dentistas"><span class="oi oi-graph"></span><span class="navitem ml-2">Relatório [Dentistas]</span></li>
        <?php } ?>

        <li class="link" data-link="perfil"><span class="oi oi-person"></span><span class="navitem ml-2">Perfil</span></li>

        <!-- <?php if(permissao("configuracoes")){ ?>
        <li class="link" data-link="configuracoes"><i class="fas fa-cog"></i> <span>Configurações</span></li>
        <?php } ?> -->

        <li class="link" data-link="configuracoes"><span class="oi oi-dashboard"></span><span class="navitem ml-2">Configurações</span></li>

        <li class="link" data-link="parts/functional/logout.php"><span class="oi oi-account-logout"></span><span class="navitem ml-2">Sair</span></li>
    </ul>
</nav>