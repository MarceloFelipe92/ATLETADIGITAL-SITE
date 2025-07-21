<!-- Barra Superior -->
<nav class="navbar navbar-expand-lg shadow-lg navbar-dark navbar-custom">
    <div class="container-fluid justify-content-between">
        <!-- Título do Painel -->
        <h5 class="text-white m-0">
            <i class="fas fa-tools me-2"></i>Painel Administrativo
        </h5>
        <!-- Botão de Logout -->
        <a href="<?php echo $_SESSION["url"]; ?>/encerrar-sessao.php" class="btn text-white btn-outline-success ">
            <i class="fas fa-sign-out-alt me-1"></i> Sair
        </a>
    </div>
</nav>

<!-- Menu Lateral -->
<nav class="sidebar position-fixed d-flex flex-column align-items-center shadow-lg text-white p-4 "
    style="font-size: 0.9rem;">

    <!-- Perfil do Usuário -->
    <div class="text-center w-100 mb-4 mt-2">
        <div class="position-relative d-inline-block">
            <img src="#" alt="Foto de Perfil" class="rounded-circle shadow  border-3 border-success">
            <div class="position-absolute bottom-0 end-0 bg-success rounded-circle border border-light"
                style="width: 20px; height: 20px;"></div>
        </div>
        <h5 class="fw-semibold mt-3 mb-0">Admin</h5>
        <small class="text-white">Gerenciador</small>
    </div>

    <!-- Links do Menu -->
    <ul class="nav flex-column w-100">

        <!-- Seção Principal -->
        <li class="nav-item ">
            <h6 class="text-white ">Principal</h6>
        </li>
        <li class="nav-item mb-2">
            <a href="<?php echo $_SESSION['url']; ?>/index.php"
                class="btn text-white btn-outline-success w-100 shadow-sm <?php echo $pagina == 'dashboard' ? ' active ' : ''; ?>">
                <i class="fas fa-home text-white me-2"></i> Dashboard
            </a>
        </li>

        <!-- Seção Cadastros -->
        <li class="nav-item mt-2">
            <h6 class="text-white ">Cadastros</h6>
        </li>
        <li class="nav-item mb-2">
            <a href="<?php echo $_SESSION['url']; ?>/contatos/formulario-contato.php"
                class="btn text-white btn-outline-success w-100 shadow-sm <?php echo $pagina == 'contatos' ? ' active ' : ''; ?>">
                <i class="fas fa-address-book text-white me-2"></i> Contatos
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="<?php echo $_SESSION['url']; ?>/clientes"
                class="btn text-white btn-outline-success w-100 shadow-sm <?php echo $pagina == 'clientes' ? ' active ' : ''; ?>">
                <i class="fas fa-users text-white me-2"></i> Clientes
            </a>
        </li>
        <li class="nav-item mb-2">
            <a href="<?php echo $_SESSION['url']; ?>/fornecedores"
                class="btn text-white btn-outline-success w-100 shadow-sm <?php echo $pagina == 'fornecedores' ? ' active ' : ''; ?>">
                <i class="fas fa-truck text-white me-2"></i> Fornecedores
            </a>
        </li>

        <!-- Seção Produtos-->
        <li class="nav-item mt-2">
            <h6 class="text-white ">Produtos</h6>
        </li>
        <li class="nav-item mb-2">
            <a href="<?php echo $_SESSION['url']; ?>/produtos"
                class="btn text-white btn-outline-success w-100 shadow-sm <?php echo $pagina == 'produtos' ? ' active ' : ''; ?>">
                <i class="fas fa-box text-white me-2"></i> Produtos
            </a>
        </li>

        <!-- Carrinho -->
        <li class="nav-item mb-2">
            <a href="<?php echo $_SESSION['url']; ?>/carrinho"
                class="btn text-white btn-outline-success w-100 shadow-sm <?php echo $pagina == 'carrinho' ? ' active ' : ''; ?>">
                <i class="fas fa-shopping-cart text-white me-2"></i> Carrinho
            </a>
        </li>

    </ul>
</nav>