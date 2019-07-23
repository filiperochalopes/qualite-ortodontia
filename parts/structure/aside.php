<div class="d-none d-sm-block col-sm-2 col-md-3 col-lg-3 pt-5 pb-5" id="aside-container">
    <aside>
        <ul>
            <li class="link" data-link="principal"><i class="fas fa-home"></i><span class="navitem ml-2">Principal</span></li>

            <?php if(permissao("novo-atendimento")){ ?>
            <li class="link" data-link="novo-atendimento"><i class="far fa-plus-square"></i><span class="navitem ml-2">Novo atendimento</span></li>
            <?php } ?>

            <?php if(permissao("iniciar-atendimento")){ ?>
            <li class="link" data-link="iniciar-atendimento"><i class="far fa-play-circle"></i><span class="navitem ml-2">Iniciar atendimento</span></li>
            <?php } ?>
            
            <?php if(permissao("meus-atendimentos")){ ?>
            <li class="link" data-link="meus-atendimentos"><i class="far fa-list-alt"></i><span class="navitem ml-2">Meus atendimentos</span></li>
            <?php } ?>

            <?php if(permissao("validacao-cadastro")){ ?>
            <li class="link" data-link="validacao-cadastro"><i class="fas fa-clipboard-check"></i><div class="num_notificacoes"><?=num_dentistas()[1]?></div><span class="navitem ml-2">Validação de cadastro</span></li>
            <?php } ?>

            <?php if(permissao("cadastro-dentista")){ ?>
            <li class="link" data-link="cadastro-dentista"><i class="far fa-plus-square"></i><span class="navitem ml-2">Cadastro de dentista</span></li>
            <?php } ?>

            <?php if(permissao("cadastro-convenios")){ ?>
            <li class="link" data-link="cadastro-convenios"><i class="far fa-plus-square"></i><span class="navitem ml-2">Cadastro de convênios</span></li>
            <?php } ?>

            <?php if(permissao("atendimentos")){ ?>
            <li class="link" data-link="atendimentos"><i class="far fa-list-alt"></i><span class="navitem ml-2">Todos os Atendimentos</span></li>
            <?php } ?>

            <?php if(permissao("atendimentos-atendente")){ ?>
            <li class="link" data-link="atendimentos-atendente"><i class="far fa-list-alt"></i><span class="navitem ml-2">Atendimentos</span></li>
            <?php } ?>

            <?php if(permissao("guia-recebimento")){ ?>
            <li class="link" data-link="guia-recebimento"><i class="fas fa-receipt"></i><span class="navitem ml-2">Recebimento de Guias</span></li>
            <?php } ?>

            <?php if(permissao("guias-pagas")){ ?>
            <li class="link" data-link="guias-pagas"><i class="fas fa-coins"></i><span class="navitem ml-2">Ver Guias pagas</span></li>
            <?php } ?>

            <?php if(permissao("relatorio-guias")){ ?>
            <li class="link" data-link="relatorio-guias"><i class="fas fa-chart-line"></i><span class="navitem ml-2">Relatório [Guias]</span></li>
            <?php } ?>

            <?php if(permissao("relatorio-dentistas")){ ?>
            <li class="link" data-link="relatorio-dentistas"><i class="fas fa-chart-line"></i><span class="navitem ml-2">Relatório [Dentistas]</span></li>
            <?php } ?>

            <li class="link" data-link="perfil"><i class="far fa-user"></i><span class="navitem ml-2">Perfil</span></li>

            <!-- <?php if(permissao("configuracoes")){ ?>
            <li class="link" data-link="configuracoes"><i class="fas fa-cog"></i> <span>Configurações</span></li>
            <?php } ?> -->

            <li class="link" data-link="configuracoes"><i class="fas fa-cog"></i><span class="navitem ml-2">Configurações</span></li>
            
            <li class="link" data-link="parts/functional/logout.php"><i class="fas fa-sign-out-alt"></i><span class="navitem ml-2">Sair</span></li>
        </ul>
    </aside>
</div>