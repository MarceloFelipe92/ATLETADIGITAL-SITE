<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $client = $response["data"][0];
    } else {
        $client = null;
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Cliente</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php include '../navbar.php'; ?>
    <?php include '../mensagens.php'; ?>

    <div class="content">
        <div class="container mt-4">
            <h3 class="mb-4"><i class="fas fa-users text-primary"></i> Painel de Gerenciamento - Cliente</h3>
            <p class="text-muted">Gerencie os clientes e suas informações pessoais e de contato.</p>
            <hr>
        </div>
    </div>

    <div class="content">
        <div class="container mt-4">
            <div class="container py-5 shadow-lg bg-white rounded-5">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h2 class="text-dark"><i class="fas fa-users me-2"></i>Clientes Cadastrados</h2>
                    <a href="<?php echo $_SESSION["url"]; ?>index.php" class="btn btn-outline-success shadow-sm">
                        <i class="fas fa-arrow-left me-2"></i>Voltar
                    </a>
                    <div>
                        <a href="/clientes/detalhe-cliente.php" class="btn btn-outline-primary shadow-sm">
                            <i class="fas fa-plus"></i> Novo Cliente
                        </a>
                        <a href="/clientes/exportar.php" class="btn btn-outline-success shadow-sm">
                            <i class="fas fa-file-excel"></i> Exportar Excel
                        </a>
                        <a href="/clientes/exportar_pdf.php" class="btn btn-outline-danger shadow-sm">
                            <i class="fas fa-file-pdf"></i> Exportar PDF
                        </a>
                    </div>
                </div>
                <!-- Tabela de clientes cadastrados -->
                <div class="table-responsive shadow-lg rounded-4">
                    <table id="myTable" class="table table-hover align-middle">
                        <thead class="table-dark text-uppercase">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Imagem</th>
                                <th scope="col">Nome</th>
                                <th scope="col">CPF</th>
                                <th scope="col">E-mail</th>
                                <th scope="col">Senha</th>
                                <th scope="col">Whatsapp</th>
                                <th scope="col">Ações</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            // SE HOUVER CLIENTES NA SESSÃO, EXIBIR
                            $key = null; // Limpar a variável para trazer TODOS os clientes
                            require("../requests/clientes/get.php");
                            if (!empty($response)) {
                                foreach ($response["data"] as $key => $client) {
                                    echo '
                                        <tr style="vertical-align:middle">
                                            <th scope="row">' . $client["id_cliente"] . '</th>
                                                <td><img width="60" src="/clientes/imagens/' . $client["imagem"] . '" class="img-thumbnail"></td>
                                                <td>' . $client["nome"] . '</td>
                                                <td>' . $client["cpf"] . '</td>
                                                <td>' . $client["email"] . '</td>
                                                <td>' . (isset($client["senha"]) ? "******" : "N/A") . '</td>
                                                <td>' . $client["whatsapp"] . '</td>
                                                <td>
                                            <a href="/clientes/detalhe-cliente.php?key=' . $client["id_cliente"] . '" class="btn btn-sm btn-outline-primary me-2 mb-2">
                                                <i class="fas fa-edit"></i> Editar
                                            </a>
                                            <a href="/clientes/remover.php?key=' . $client["id_cliente"] . '" class="btn btn-sm btn-outline-danger">
                                                <i class="fas fa-trash"></i> Excluir
                                            </a>
                                        </td>
                                    </tr>';
                                }
                            } else {
                                echo '
                                <tr>
                                    <td colspan="7" class="text-center">
                                        <div class="alert alert-info p-4 mb-0 shadow-sm">
                                            <i class="fas fa-info-circle fa-lg me-2 text-primary"></i>
                                            Nenhum cliente cadastrado até o momento.
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