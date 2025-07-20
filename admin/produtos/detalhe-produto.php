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
    <title>Cadastrar Produto - Produto</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="form-container mt-5 ">
        <h1 class="text-center  text-white mb-4"><i class="fas fa-dumbbell  me-2"></i>Cadastro de Produto</h1>
        <p class="text-center  text-white">Preencha os campos abaixo para cadastrar um novo produto do setor de
            produto.</p>
        <a href="./index.php" class="btn  text-white btn-outline-success mb-2 ">
            <i class="fas fa-arrow-left me-2  text-white"></i>Voltar
        </a>
        <div class="card shadow-lg p-4">
            <h2 class="mb-2 text-dark"><i class="fas fa-dumbbell "></i></h2>
            <form id="myForm" method="POST" action="/produtos/cadastrar.php" enctype="multipart/form-data">

                <input type="text" class="form-control" id="productId" name="productId" readonly
                    value="<?php echo isset($product) ? $product["id_produto"] : ""; ?>">

                <div class="mb-3">
                    <label for="brandId" class="form-label">Setor</label>
                    <select name="brandId" id="brandId" class="form-select" required>
                        <option value="" selected>Selecione uma marca</option>
                        <?php
                        // Carrega as marcas do banco de dados
                        require("../requests/marcas/get.php");
                        if (!empty($response)) {
                            foreach ($response["data"] as $marcas) {
                                $selected = (isset($product) && $product["id_marca"] == $marcas["id_marca"]) ? "selected" : "";
                                echo '<option value="' . $marcas["id_marca"] . '" ' . $selected . '>' . $marcas["marca"] . '</option>';
                            }
                        }
                        ?>
                    </select>
                </div>
                <hr>
                <div class="mb-3">
                    <label for="productName" class="form-label">Nome do Produto</label>
                    <input type="text" name="productName" id="productName" class="form-control" required
                        value="<?php echo isset($product) ? $product["produto"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="productDescription" class="form-label">Descrição</label>
                    <textarea name="productDescription" id="productDescription" class="form-control" rows="4"
                        required><?php echo isset($product) ? $product["descricao"] : ""; ?></textarea>
                </div>

                <div class="mb-3">
                    <label for="productPrice" class="form-label">Preço (R$)</label>
                    <input type="number" step="0.01" name="productPrice" id="productPrice" class="form-control" required
                        value="<?php echo isset($product) ? $product["preco"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="productQuantity" class="form-label">Quantidade Estoque</label>
                    <input type="number" name="productQuantity" id="productQuantity" class="form-control" required
                        value="<?php echo isset($product) ? $product["quantidade"] : ""; ?>">
                </div>

                <div class="mb-3">
                    <label for="productImage" class="form-label">Imagem do Produto</label>
                    <input type="file" name="productImage" id="productImage" class="form-control" accept="image/*">
                </div>


                <div class="mb-3">
                    <?php
                    // SE HOUVER IMAGEM NO PRODUTO, EXIBIR MINIATURA
                    if (isset($product["imagem"])) {
                        echo '
                                        <div class="mb-3">
                                            <input type="hidden" name="currentProductImage" value="' . $product["imagem"] . '">
                                            <img width="100" src="imagens/' . $product["imagem"] . '" class="img-thumbnail">
                                        </div>
                                        ';
                    }
                    ?>
                </div>
            </form>


            <div class="row g-3">
                <div class="col-md-4">
                    <button form="myForm" type="submit" class="btn btn-outline-success w-100  shadow-sm">
                        <i class="fas fa-save me-2"></i>Salvar Produto
                    </button>
                </div>
                <div class="col-md-4">
                    <a href="../produtos/index.php" class="btn btn-outline-secondary w-100  shadow-sm">
                        <i class="fas fa-list me-2"></i>Ver Produtos Cadastrados
                    </a>
                </div>

            </div>

        </div>
    </div>

    <!-- Bootstrap JS (opcional, para funcionalidades como o menu hamburguer) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- jQuery Mask Plugin -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>


</body>

</html>