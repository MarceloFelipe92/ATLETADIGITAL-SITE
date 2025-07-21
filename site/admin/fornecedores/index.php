<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/fornecedores/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único fornecedor na posição [0]
        $provider = $response["data"][0];
    } else {
        $provider = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel Fornecedores</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <!-- Datatable -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.2/css/dataTables.dataTables.min.css">
    <link rel="stylesheet" href="../style.css">


</head>

<body style="background-color: rgba(179, 248, 225, 0.2);">

    <?php
    // Inclui mensagens e barra de navegação
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="content">
        <div class="container mt-4">
            <h3 class="mb-4"><i class="fas fa-truck text-primary"></i> Painel de Gerenciamento - Fornecedores</h3>
            <p class="text-muted">Gerencie os Fornecedores e suas informações</p>
            <hr>
        </div>
    </div>
    <div class="container mt-4">

        <div class="container py-5 shadow-lg bg-white rounded-5">
            <!-- Cabeçalho da página -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-dark"><i class="fas fa-truck me-2"></i>Fornecedores Cadastrados</h2>

                <div>
                    <!-- Botões de ações -->
                    <a href="<?php echo $_SESSION["url"]; ?>./" class="btn btn-outline-success shadow-sm ">
                        <i class="fas fa-arrow-left me-2"></i>Voltar
                    </a>
                    <a href="/fornecedores/detalhe-fornecedor.php" class="btn btn-outline-primary shadow-sm"><i
                            class="fas fa-plus"></i> Novo Fornecedor</a>
                    <a href="/fornecedores/exportar.php" class="btn btn-outline-success shadow-sm"><i
                            class="fas fa-file-excel"></i> Exportar Excel</a>
                    <a href="/fornecedores/exportar.pdf.php" class="btn btn-outline-danger shadow-sm"><i
                            class="fas fa-file-pdf"></i> Exportar PDF</a>
                </div>
            </div>
            <!-- Tabela de fornecedores -->


            <table id="myTable" class="table table-hover ">


                <thead class="table-dark text-uppercase">
                    <tr>

                        <th scope="col" class="text-center">#</th>
                        <th scope="col" class="text-center">Razão Social</th>
                        <th scope="col" class="text-center">CNPJ</th>
                        <th scope="col" class="text-center">E-mail</th>
                        <th scope="col" class="text-center">Telefone</th>
                        <th scope="col" class="text-center">Ações</th>
                    </tr>
                </thead>
                <tbody id="proviederTableBody">
                    <?php
                    // SE HOUVER FORNECEDORES NA SESSÃO, EXIBIR
                    $key = null; // Limpar a variável para trazer TODOS os fornecedores
                    require("../requests/fornecedores/get.php");
                    if (!empty($response)) {
                        foreach ($response["data"] as $key => $provider) {
                            echo '
                                        <tr>
                                            <th scope="row">' . $provider["id_fornecedor"] . '</th>
                                            <td>' . $provider["razao_social"] . '</td>
                                            <td>' . $provider["cnpj"] . '</td>
                                            <td>' . $provider["email"] . '</td>
                                            <td>' . $provider["telefone"] . '</td>
                                            <td>
                                        <a href="../fornecedores/detalhe-fornecedor.php?key=' . $provider["id_fornecedor"] . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i>Editar</a>
                                        <a href="../fornecedores/remover.php?key=' . $provider["id_fornecedor"] . '" class="btn btn-sm btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i>Excluir</a>
                                    </td>
                                </tr>
                                ';
                        }
                    } else {
                        // Mensagem caso não haja fornecedores cadastrados
                        echo '
                        <tr>
                            <td colspan="7" class="text-center">
                                     <div class="alert alert-info  mb-0 shadow-sm">
                                             <i class="fas fa-info-circle fa-lg me-2 text-primary"></i>Nenhum fornecedor cadastrado até o momento.
                                      </div>
                            </td>
                        </tr>';
                    }
                    ?>
                </tbody>


            </table>

        </div>





    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
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