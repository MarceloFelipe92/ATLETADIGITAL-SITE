<?php
if (!session_id()) {
    session_start();
}
include "../verificar-autenticacao.php";
$pagina = "carrinho";
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Carrinhos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <!-- Datatable -->
    <link href="https://cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php include '../navbar.php'; ?>
    <?php include '../mensagens.php'; ?>

    <div class="content">
        <div class="container mt-4">
            <h3 class="mb-4">
                <i class="fas fa-shopping-cart text-primary"></i> Painel de Gerenciamento - Carrinhos
            </h3>
            <p class="text-muted">Visualize e gerencie os carrinhos cadastrados no sistema.</p>
            <hr>
        </div>
    </div>


    <div class="container mt-4">
        <div class="container py-5 shadow-lg bg-white rounded-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-dark"><i class="fas fa-shopping-basket me-2"></i>Carrinhos Cadastrados</h2>
                <a href="<?php echo $_SESSION["url"]; ?>index.php" class="btn btn-outline-success shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <a href="/carrinho/formulario.php" class="btn btn-outline-primary shadow-sm">
                        <i class="fas fa-plus"></i> Novo Carrinho
                    </a>
                    <a href="/carrinho/exportar.php" class="btn btn-outline-success shadow-sm">
                        <i class="fas fa-file-excel"></i> Exportar Excel
                    </a>
                    <a href="/carrinho/exportar_pdf.php" class="btn btn-outline-danger shadow-sm">
                        <i class="fas fa-file-pdf"></i> Exportar PDF
                    </a>
                </div>
            </div>

            <div class="table-responsive shadow-lg rounded-4">
                <table id="myTable" class="table table-hover align-middle">
                    <thead class="table-dark text-uppercase">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Data</th>
                            <th scope="col">Produtos</th>
                            <th scope="col" class="text-center">Qtd Total</th>
                            <th scope="col" class="text-center">Preço Total</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require "../requests/carrinho/get.php"; // Ajustado para o caminho correto
                        if ($response['status'] === 'success' && !empty($response['data']['items'])) {
                            foreach ($response['data']['items'] as $key => $item) {
                                $quantidade_total = array_sum(array_column($item['produtos'], 'quantidade'));
                                $produtos_lista = [];
                                foreach ($item['produtos'] as $produto) {
                                    $produtos_lista[] = htmlspecialchars($produto['produto']) . ' (x' . $produto['quantidade'] . ')';
                                }
                                echo '
                                        <tr style="vertical-align: middle">
                                            <th scope="row">' . htmlspecialchars($item['id_carrinho']) . '</th>
                                            <td>' . htmlspecialchars($item['cliente_nome']) . '</td>
                                            <td>' . htmlspecialchars($item['data']) . '</td>
                                            <td>' . implode(', ', $produtos_lista) . '</td>
                                            <td class="text-center">' . htmlspecialchars($quantidade_total) . '</td>
                                            <td class="text-center">R$ ' . number_format($item['preco_total'] ?? 0, 2, ',', '.') . '</td>
                                            <td class="text-center">
                                                <a href="/carrinho/editar.php?id=' . htmlspecialchars($item['id_carrinho']) . '" class="btn btn-warning btn-sm">Editar</a>
                                                <a href="/carrinho/remover.php?id=' . htmlspecialchars($item['id_carrinho']) . '" class="btn btn-sm btn-danger">Excluir</a>
                                            </td>
                                        </tr>';
                            }
                        } else {
                            echo '<tr>
            <td colspan="7" class="text-center">
                <div class="alert alert-info p-4 mb-0 shadow-sm">
                    <i class="fas fa-info-circle fa-lg me-2 text-primary"></i>
                    Nenhum carrinho encontrado ou erro: ' . htmlspecialchars($response['message'] ?? 'Sem dados') . '
                </div>
            </td>
        </tr>';
                        }


                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- DataTables -->
    <script src="https://cdn.datatables.net/2.3.2/js/dataTables.min.js"></script>
    <script>
        let table = new DataTable('#myTable', {
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.3.2/i18n/pt-BR.json',
            },
        });
    </script>
</body>

</html>