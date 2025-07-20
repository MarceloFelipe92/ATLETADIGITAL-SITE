<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "produtos";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/produtos/get.php");
    $key = null;
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único fornecedor na posição [0]
        $product = $response["data"][0];
    } else {
        $product = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Painel Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <h3 class="mb-4"><i class="fas fa-users text-primary"></i> Painel de Gerenciamento - Produtos</h3>
            <p class="text-muted">Gerencie os Produtos e suas informações</p>
            <hr>

        </div>
    </div>


    <div class="container mt-4">

        <div class="container py-5 shadow-lg bg-white rounded-5">
            <!-- Cabeçalho da página -->
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h2 class="text-dark"><i class="fas fa-users me-2"></i>Produtos Cadastrados</h2>
                <a href="<?php echo $_SESSION["url"]; ?>index.php" class="btn btn-outline-success shadow-sm">
                    <i class="fas fa-arrow-left me-2"></i>Voltar
                </a>
                <div>
                    <!-- Botões de ações -->
                    <a href="/produtos/detalhe-produto.php" class="btn btn-outline-primary shadow-sm"><i
                            class="fas fa-plus"></i> Novo Produto</a>
                    <a href="/produtos/exportar.php" class="btn btn-outline-success shadow-sm"><i
                            class="fas fa-file-excel"></i> Exportar Excel</a>
                    <a href="/produtos/exportar.pdf.php" class="btn btn-outline-danger shadow-sm"><i
                            class="fas fa-file-pdf"></i> Exportar PDF</a>
                </div>
            </div>

            <!-- Tabela de produtos -->
            <div class="table-responsive shadow-lg rounded-4">
                <table id="myTable" class="table table-hover align-middle">
                    <thead class="table-dark text-uppercase">
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Imagem</th>
                            <th scope="col" class="text-center">Produto</th>
                            <th scope="col" class="text-center">Marca</th>
                            <th scope="col" class="text-center">Quantidade</th>
                            <th scope="col" class="text-center">Preço</th>
                            <th scope="col" class="text-center">Ações</th>
                        </tr>
                    </thead>
                    <tbody id="productTableBody">
                        <?php
                        // SE HOUVER PRODUTOS NA SESSÃO, EXIBIR
                        require("../requests/produtos/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $key => $product) {
                                echo '
                                        <tr style="vertical-align:middle">
                                            <th scope="row">' . $product["id_produto"] . '</th>
                                            <td>
                                                <img src="/produtos/imagens/' . $product["imagem"] . '" alt="Imagem do Produto" class="img-thumbnail" style="max-width: 100px;">
                                            </td>
                                            <td>' . $product["produto"] . '</td>
                                            <td class="text-center">' . $product["marca"] . '</td>
                                            <td class="text-center">' . $product["quantidade"] . '</td>
                                            <td class="text-center">R$ ' . number_format($product["preco"], 2, ',', '.') . '</td>
                                            <td>
                         <a href="/produtos/detalhe-produto.php?key=' . $product["id_produto"] . '" class="btn btn-sm btn-outline-primary btn-sm me-2 mb-2"><i class="fas fa-edit"></i> Editar</a>
                         <a href="/produtos/remover.php?key=' . $product["id_produto"] . '" class="btn btn-sm btn-outline-danger btn-sm me-2"><i class="fas fa-trash"></i> Excluir</a>
                     </td>
                    </tr>
                    ';
                            }
                        } else {

                            // Mensagem caso não haja produtos cadastrados
                            echo '
                <tr>
                    <td colspan="7" class="text-center">
                         <div class="alert alert-info p-4 mb-0 shadow-sm">
                         <i class="fas fa-info-circle fa-lg me-2 text-primary"></i>Nenhum produto cadastrado até o momento.
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

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
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