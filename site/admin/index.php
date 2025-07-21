<?php
// if (!session_id()) {
//     session_start();
// }
include "verificar-autenticacao.php";
$pagina = "dashboard";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Administrativo</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

    <link rel="stylesheet" href="./style.css">

    <style>
    /* Estilos específicos para Relógio, Calendário e Agenda */
    .relogio-card {
        font-size: 2.5em;
        font-weight: bold;
        text-align: center;
        padding: 20px;
    }

    .calendar-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 15px;
    }

    .calendar-grid {
        display: grid;
        grid-template-columns: repeat(7, 1fr);
        gap: 5px;
        text-align: center;
    }

    .calendar-day,

    .calendar-weekday {
        padding: 10px 5px;
        border-radius: 5px;
    }

    .calendar-weekday {
        font-weight: bold;
        background-color: #f8f9fa;
    }

    .calendar-day {
        background-color: #e9ecef;
        cursor: pointer;
        transition: background-color 0.2s;
    }

    .calendar-day:hover {
        background-color: #dee2e6;
    }

    .calendar-day.current-day {
        background-color: #0d6efd;
        color: white;
    }

    .calendar-day.has-event {

        background-color: #ffc107;
        /* Cor para dias com eventos */
        color: #343a40;
        font-weight: bold;
    }

    .agenda-event {
        display: flex;
        justify-content: space-between;

        align-items: center;
    }

    .agenda-event .btn-danger {
        margin-left: 10px;
    }
    </style>
</head>

<body>

    <?php
    // Inclui mensagens e barra de navegação
    include "mensagens.php";
    include "navbar.php";
    ?>

    <div class="content py-5">
        <div class="container">
            <h2 class="dashboard-heading text-center">
                <i class="fas fa-cogs me-2 text-primary"></i>Painel Administrativo
            </h2>

            <div class="row gy-4">
                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-primary border-2">
                        <h4><i class="fas fa-users me-2 text-primary"></i>Clientes
                            <?php require("requests/clientes/get.php"); ?>
                        </h4>
                        <p>Gerencie todos os clientes no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/clientes" class="btn btn-outline-primary w-100 mb-2">
                            <i class="fas fa-users"></i> Acessar
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-success border-2">
                        <h4><i class="fas fa-truck me-2 text-success"></i>Fornecedores
                            <?php require("requests/fornecedores/get.php"); ?>
                        </h4>
                        <p>Controle de todos os fornecedores no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/fornecedores"
                            class="btn btn-outline-success w-100 mb-2">
                            <i class="fas fa-truck"></i> Acessar
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-danger border-2">
                        <h4><i class="fas fa-box-open me-2 text-danger"></i>Produtos
                            <?php require("requests/produtos/get.php"); ?>
                        </h4>
                        <p>Gerencie todos os produtos no sistema.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/produtos" class="btn btn-outline-danger w-100 mb-2">
                            <i class="fas fa-box-open"></i> Acessar
                        </a>
                    </div>
                </div>

                <div class="col-md-6 col-lg-3">
                    <div class="category-card border-start border-info border-2">
                        <h4><i class="fas fa-shopping-cart me-2 text-info"></i>Carrinho
                            <?php require("requests/carrinho/get.php"); ?>
                        </h4>
                        <p>Gerencie os itens no carrinho de compras.</p>
                        <a href="<?php echo $_SESSION["url"]; ?>/carrinho" class="btn btn-outline-info w-100 mb-2">
                            <i class="fas fa-shopping-cart"></i> Acessar
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-4 justify-content-center">
                <div class="col-6 col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="text-muted"><i class="fas fa-users me-2 text-primary"></i>Total de Clientes</h5>
                            <?php require("requests/clientes/get.php"); ?>
                            <span
                                class="fs-3 fw-bold"><?php echo isset($response['data']) ? count($response['data']) : 0; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="text-muted"><i class="fas fa-truck me-2 text-success"></i>Total de Fornecedores
                            </h5>
                            <?php require("requests/fornecedores/get.php"); ?>
                            <span
                                class="fs-3 fw-bold"><?php echo isset($response['data']) ? count($response['data']) : 0; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="text-muted"><i class="fas fa-box-open me-2 text-danger"></i>Total de Produtos
                            </h5>
                            <?php require("requests/produtos/get.php"); ?>
                            <span
                                class="fs-3 fw-bold"><?php echo isset($response['data']) ? count($response['data']) : 0; ?></span>
                        </div>
                    </div>
                </div>
                <div class="col-6 col-md-3 mb-3">
                    <div class="card bg-light border-0 shadow-sm h-100">
                        <div class="card-body text-center">
                            <h5 class="text-muted"><i class="fas fa-shopping-cart me-2 text-info"></i>Total no Carrinho
                            </h5>
                            <span class="fs-3 fw-bold">
                                <?php echo isset($response['data']['items']) ? count($response['data']['items']) : 0; ?>
                            </span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-calendar-alt text-info me-2"></i>Próximos Eventos</h5>
                </div>
                <div class="card-body p-2">
                    <div class="list-group list-group-flush">
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex justify-content-between">
                                <span>Reabastecimento estoque</span>
                                <small class="text-muted">15/05</small>
                            </div>
                        </a>
                        <a href="#" class="list-group-item list-group-item-action border-0">
                            <div class="d-flex justify-content-between">
                                <span>Pagamento fornecedores</span>
                                <small class="text-muted">20/05</small>
                            </div>
                        </a>
                    </div>
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-exclamation-triangle text-warning me-2"></i>Alertas
                                Importantes</h5>
                        </div>
                        <div class="card-body">
                            <?php
                            // Busca produtos com estoque crítico (menor ou igual a 10 unidades)
                            require_once("requests/produtos/get.php");
                            $produtosCriticos = [];

                            if (isset($response['data']) && is_array($response['data'])) {
                                foreach ($response['data'] as $produto) {
                                    // Ajuste: menor ou igual a 10
                                    if (isset($produto['quantidade']) && $produto['quantidade'] <= 10) {
                                        $produtosCriticos[] = $produto;
                                    }
                                }
                            }

                            if (count($produtosCriticos) > 0):
                            ?>
                            <div class="alert alert-warning d-flex align-items-center mb-3">
                                <i class="fas fa-box me-3 fs-4"></i>
                                <div>
                                    <strong><?php echo count($produtosCriticos); ?>
                                        produto<?php echo count($produtosCriticos) > 1 ? 's' : ''; ?> com estoque
                                        crítico</strong>
                                    <p class="mb-0 small">
                                        <?php foreach ($produtosCriticos as $p): ?>
                                        <span class="badge bg-warning text-dark mb-1">
                                            <?php echo htmlspecialchars($p['produto']); ?>:
                                            <?php echo $p['quantidade']; ?> unidade(s)
                                        </span>
                                        <?php endforeach; ?>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <?php
                            $produtosEstoqueAlto = [];
                            if (isset($response['data']) && is_array($response['data'])) {
                                foreach ($response['data'] as $produto) {
                                    if (isset($produto['quantidade']) && $produto['quantidade'] >= 30) {
                                        $produtosEstoqueAlto[] = $produto;
                                    }
                                }
                            }
                            if (count($produtosEstoqueAlto) > 0):
                            ?>
                            <div class="alert alert-success d-flex align-items-center mb-3">
                                <i class="fas fa-boxes me-3 fs-4"></i>
                                <div>
                                    <strong><?php echo count($produtosEstoqueAlto); ?>
                                        produto<?php echo count($produtosEstoqueAlto) > 1 ? 's' : ''; ?> com estoque
                                        alto</strong>
                                    <p class="mb-0 small">
                                        <?php foreach ($produtosEstoqueAlto as $p): ?>
                                        <span class="badge bg-success text-light mb-1">
                                            <?php echo htmlspecialchars($p['produto']); ?>:
                                            <?php echo $p['quantidade']; ?> unidade(s)
                                        </span>
                                        <?php endforeach; ?>
                                    </p>
                                </div>
                            </div>
                            <?php endif; ?>
                            <div class="alert alert-info d-flex align-items-center">
                                <i class="fas fa-truck me-3 fs-4"></i>
                                <div>
                                    <strong>3 pedidos para enviar hoje</strong>
                                    <p class="mb-0 small">Prazo de entrega próximo</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-bolt text-primary me-2"></i>Ações Rápidas</h5>
                        </div>
                        <div class="card-body">
                            <div class="row g-2">
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/produtos/adicionar"
                                        class="btn btn-outline-primary w-100 mb-2">
                                        <i class="fas fa-plus-circle me-1"></i> Novo Produto
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION['url']; ?>/contatos/formulario-contato.php"
                                        class=" btn btn-outline-success w-100 mb-2">
                                        <i class="fas fa-envelope me-1"></i> Contato
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/clientes/adicionar"
                                        class="btn btn-outline-info w-100 mb-2">
                                        <i class="fas fa-user-plus me-1"></i> Novo Cliente
                                    </a>
                                </div>
                                <div class="col-md-6">
                                    <a href="<?php echo $_SESSION["url"]; ?>/relatorios"
                                        class="btn btn-outline-secondary w-100 mb-2">
                                        <i class="fas fa-file-alt me-1"></i> Gerar Relatório
                                    </a>
                                </div>
                            </div>
                            <hr>
                            <h6 class="mt-3"><i class="fas fa-bullhorn text-warning me-2"></i>Campanha Ativa</h6>
                            <div class="alert alert-light border">
                                <strong>FRETE GRÁTIS</strong> - Para compras acima de R$ 200,00
                                <div class="mt-2">
                                    <span class="badge bg-success">Ativa</span>
                                    <small class="text-muted ms-2">Termina em 5 dias</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-4 gy-4">
                <div class="col-lg-4">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-clock text-primary me-2"></i>Relógio</h5>
                        </div>
                        <div class="card-body d-flex align-items-center justify-content-center">
                            <div id="clock" class="relogio-card text-dark">00:00:00</div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-8">
                    <div class="card shadow-sm h-100">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-calendar-alt text-success me-2"></i>Calendário</h5>
                        </div>
                        <div class="card-body">
                            <div class="calendar-header">
                                <button class="btn btn-sm btn-outline-secondary" id="prevMonth"><i
                                        class="fas fa-chevron-left"></i></button>
                                <h4 class="mb-0" id="currentMonthYear"></h4>
                                <button class="btn btn-sm btn-outline-secondary" id="nextMonth"><i
                                        class="fas fa-chevron-right"></i></button>
                            </div>
                            <div class="calendar-grid" id="calendarGrid">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12">
                    <div class="card shadow-sm">
                        <div class="card-header bg-white">
                            <h5 class="mb-0"><i class="fas fa-clipboard-list text-info me-2"></i>Minha Agenda</h5>
                        </div>
                        <div class="card-body">
                            <form id="eventForm" class="mb-3">
                                <div class="row g-2">
                                    <div class="col-md-5">
                                        <input type="text" id="eventTitle" class="form-control"
                                            placeholder="Título do evento" required>
                                    </div>
                                    <div class="col-md-4">
                                        <input type="date" id="eventDate" class="form-control" required>
                                    </div>
                                    <div class="col-md-3">
                                        <button type="submit" class="btn btn-primary w-100">Adicionar Evento</button>
                                    </div>
                                </div>
                            </form>
                            <hr>
                            <h6>Eventos para o dia selecionado: <span id="selectedDateDisplay" class="fw-bold"></span>
                            </h6>
                            <ul id="eventList" class="list-group list-group-flush">
                                <li class="list-group-item text-muted" id="noEventsMessage">Nenhum evento para este dia.
                                </li>
                            </ul>
                            <div class="mt-3 text-end">
                                <button id="clearAllEvents" class="btn btn-sm btn-outline-danger"
                                    style="display: none;">
                                    <i class="fas fa-trash-alt me-1"></i> Limpar Todos os Eventos
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card shadow-sm mt-5">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-history text-secondary me-2"></i>Últimas Vendas</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Pedido</th>
                                    <th>Cliente</th>
                                    <th>Data</th>
                                    <th>Valor</th>
                                    <th>Status</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>#1025</td>
                                    <td>João Silva</td>
                                    <td>10/05/2023</td>
                                    <td>R$ 249,90</td>
                                    <td><span class="badge bg-success">Entregue</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>#1024</td>
                                    <td>Maria Souza</td>
                                    <td>09/05/2023</td>
                                    <td>R$ 189,90</td>
                                    <td><span class="badge bg-warning">Em transporte</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary"><i
                                                class="fas fa-eye"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <a href="<?php echo $_SESSION["url"]; ?>/vendas" class="btn btn-sm btn-outline-secondary mt-2">Ver
                        todas as vendas</a>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-star text-warning me-2"></i>Top 5 Produtos</h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Produto</th>
                                    <th>Categoria</th>
                                    <th>Vendas</th>
                                    <th>Estoque</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>Camiseta Performance</td>
                                    <td>Roupas</td>
                                    <td>128</td>
                                    <td class="text-success">42</td>
                                </tr>
                                <tr>
                                    <td>Whey Protein 1kg</td>
                                    <td>Suplementos</td>
                                    <td>95</td>
                                    <td class="text-warning">8</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card shadow-sm mt-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0"><i class="fas fa-link text-secondary me-2"></i>Links Importantes</h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-6 mb-2">
                            <a href="https://www.receita.fazenda.gov.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-globe me-1"></i> Receita Federal
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="https://www.bcb.gov.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-university me-1"></i> Banco Central
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="https://www.sebrae.com.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-briefcase me-1"></i> Sebrae
                            </a>
                        </div>
                        <div class="col-6 mb-2">
                            <a href="https://www.inss.gov.br" target="_blank"
                                class="btn btn-sm btn-outline-secondary w-100">
                                <i class="fas fa-user-shield me-1"></i> INSS
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>

    <script>
    // --- Relógio em Tempo Real ---
    function updateClock() {
        const now = new Date();
        const hours = String(now.getHours()).padStart(2, '0');
        const minutes = String(now.getMinutes()).padStart(2, '0');
        const seconds = String(now.getSeconds()).padStart(2, '0');
        document.getElementById('clock').textContent = `${hours}:${minutes}:${seconds}`;
    }
    setInterval(updateClock, 1000); // Atualiza a cada segundo
    updateClock(); // Chama imediatamente para exibir ao carregar

    // --- Calendário e Agenda ---
    const calendarGrid = document.getElementById('calendarGrid');
    const currentMonthYear = document.getElementById('currentMonthYear');
    const prevMonthBtn = document.getElementById('prevMonth');
    const nextMonthBtn = document.getElementById('nextMonth');
    const eventForm = document.getElementById('eventForm');
    const eventTitleInput = document.getElementById('eventTitle');
    const eventDateInput = document.getElementById('eventDate');
    const eventList = document.getElementById('eventList');
    const selectedDateDisplay = document.getElementById('selectedDateDisplay');
    const noEventsMessage = document.getElementById('noEventsMessage');
    const clearAllEventsBtn = document.getElementById('clearAllEvents');

    let currentDate = new Date(); // Data atual para navegação do calendário
    let selectedDate = new Date(); // Data selecionada para exibição de eventos

    // Carregar eventos do Local Storage (simples para este exemplo)
    // Em um ambiente real, você buscaria do banco de dados via AJAX/PHP
    let events = JSON.parse(localStorage.getItem('dashboardEvents')) || {};

    function saveEvents() {
        localStorage.setItem('dashboardEvents', JSON.stringify(events));
        renderCalendar(currentDate); // Atualiza o calendário para mostrar dias com evento
        renderEventsForSelectedDate(selectedDate); // Atualiza a lista de eventos
    }

    // Função auxiliar para escapar HTML (segurança contra XSS)
    function htmlspecialchars(str) {
        const map = {
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        };
        return str.replace(/[&<>"']/g, function(m) {
            return map[m];
        });
    }

    function renderCalendar(date) {
        calendarGrid.innerHTML = ''; // Limpa o grid
        const year = date.getFullYear();
        const month = date.getMonth(); // 0-11

        currentMonthYear.textContent = new Date(year, month).toLocaleString('pt-BR', {
            month: 'long',
            year: 'numeric'
        });

        const firstDayOfMonth = new Date(year, month, 1).getDay(); // 0 (Dom) - 6 (Sáb)
        const daysInMonth = new Date(year, month + 1, 0).getDate(); // Último dia do mês

        const weekdays = ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb'];
        weekdays.forEach(day => {
            const dayHeader = document.createElement('div');
            dayHeader.classList.add('calendar-weekday');
            dayHeader.textContent = day;
            calendarGrid.appendChild(dayHeader);
        });

        // Adiciona espaços vazios para os dias antes do 1º do mês
        for (let i = 0; i < firstDayOfMonth; i++) {
            const emptyDiv = document.createElement('div');
            calendarGrid.appendChild(emptyDiv);
        }

        // Adiciona os dias do mês
        for (let i = 1; i <= daysInMonth; i++) {
            const dayDiv = document.createElement('div');
            dayDiv.classList.add('calendar-day');
            dayDiv.textContent = i;
            dayDiv.dataset.date =
                `${year}-${String(month + 1).padStart(2, '0')}-${String(i).padStart(2, '0')}`; // Formato YYYY-MM-DD

            // Marca o dia atual
            const today = new Date();
            if (i === today.getDate() && month === today.getMonth() && year === today.getFullYear()) {
                dayDiv.classList.add('current-day');
            }

            // Marca dias com eventos
            const formattedDate = dayDiv.dataset.date;
            if (events[formattedDate] && events[formattedDate].length > 0) {
                dayDiv.classList.add('has-event');
            }

            dayDiv.addEventListener('click', () => {
                selectedDate = new Date(year, month, i);
                renderEventsForSelectedDate(selectedDate);
            });
            calendarGrid.appendChild(dayDiv);
        }
    }

    function renderEventsForSelectedDate(date) {
        eventList.innerHTML = '';
        const formattedDate =
            `${date.getFullYear()}-${String(date.getMonth() + 1).padStart(2, '0')}-${String(date.getDate()).padStart(2, '0')}`;

        selectedDateDisplay.textContent = date.toLocaleDateString('pt-BR');

        const dayEvents = events[formattedDate] || [];

        if (dayEvents.length === 0) {
            noEventsMessage.style.display = 'list-item';
            clearAllEventsBtn.style.display = 'none';
        } else {
            noEventsMessage.style.display = 'none';
            clearAllEventsBtn.style.display = 'inline-block';
            dayEvents.forEach((event, index) => {
                const listItem = document.createElement('li');
                listItem.classList.add('list-group-item', 'agenda-event');
                listItem.innerHTML = `
                        <span>${htmlspecialchars(event.title)}</span>
                        <button type="button" class="btn btn-danger btn-sm delete-event-btn" data-date="${formattedDate}" data-index="${index}">
                            <i class="fas fa-trash"></i>
                        </button>
                    `;
                eventList.appendChild(listItem);
            });
            // Anexa os listeners de evento aos botões de exclusão recém-criados
            document.querySelectorAll('.delete-event-btn').forEach(button => {
                button.addEventListener('click', function() {
                    const dateToDelete = this.dataset.date;
                    const indexToDelete = parseInt(this.dataset.index);
                    deleteEvent(dateToDelete, indexToDelete);
                });
            });
        }
    }

    function deleteEvent(date, index) {
        if (events[date]) {
            events[date].splice(index, 1);
            if (events[date].length === 0) {
                delete events[date]; // Remove a chave da data se não houver mais eventos
            }
            saveEvents();
        }
    }

    eventForm.addEventListener('submit', (e) => {
        e.preventDefault(); // Impede o envio padrão do formulário
        const title = eventTitleInput.value.trim();
        const date = eventDateInput.value; // Formato YYYY-MM-DD do input type="date"

        if (title && date) {
            if (!events[date]) {
                events[date] = [];
            }
            events[date].push({
                title: title
            });
            saveEvents(); // Salva e renderiza novamente
            eventTitleInput.value = ''; // Limpa o campo de título
            eventDateInput.value = ''; // Limpa o campo de data
        } else {
            alert('Por favor, preencha o título e a data do evento.');
        }
    });

    prevMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() - 1);
        renderCalendar(currentDate);
    });

    nextMonthBtn.addEventListener('click', () => {
        currentDate.setMonth(currentDate.getMonth() + 1);
        renderCalendar(currentDate);
    });

    clearAllEventsBtn.addEventListener('click', () => {
        if (confirm('Tem certeza de que deseja limpar todos os eventos para esta data?')) {
            const formattedDate =
                `${selectedDate.getFullYear()}-${String(selectedDate.getMonth() + 1).padStart(2, '0')}-${String(selectedDate.getDate()).padStart(2, '0')}`;
            delete events[formattedDate];
            saveEvents();
        }
    });

    // Inicialização
    renderCalendar(currentDate);
    renderEventsForSelectedDate(selectedDate);
    </script>
</body>

</html>