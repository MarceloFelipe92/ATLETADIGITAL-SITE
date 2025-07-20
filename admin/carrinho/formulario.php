<?php
include "../verificar-autenticacao.php";


$pagina = "carrinho";

$cart_item = null;
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/carrinho/get.php");
    if (!empty($response['data']['items'])) {
        $cart_item = $response['data']['items'][0];
    }
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Painel - Cadastro de Item no Carrinho</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2)">

    <?php include "../navbar.php"; ?>
    <?php include "../mensagens.php"; ?>
    <div class="content">
        <div class="container mt-4">

            <h3 class="mb-4">
                <i class="fas fa-shopping-cart text-primary"></i>
                <?php echo isset($cart_item) ? 'Editar Item no Carrinho' : 'Adicionar Item ao Carrinho'; ?>
            </h3>
            <p class="text-muted">Selecione o cliente, produto e quantidade.</p>
            <hr>
            <a href="../carrinho/index.php" class="btn btn-outline-success">
                <i class=" fas fa-arrow-left me-2"></i> Voltar
            </a>
        </div>
    </div>

    <div class="content">
        <div class="container mt-4">
            <div class="container py-5 shadow-lg bg-white rounded-5">
                <form id="myForm" action="/carrinho/cadastrar.php" method="POST">
                    <div class="row">
                        <div class="col-md-2">
                            <div class="mb-3">
                                <label for="cartId" class="form-label">Código do Carrinho</label>
                                <input type="text" class="form-control" id="cartId" name="cartId" readonly
                                    value="<?php echo isset($cart_item) ? $cart_item['id_carrinho'] : ''; ?>">
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="id_cliente" class="form-label">Cliente</label>
                                <select class="form-select" id="id_cliente" name="id_cliente" required>
                                    <option value="">Selecione um cliente</option>
                                    <?php
                                    $cliente_sql = "SELECT id_cliente, nome FROM clientes ORDER BY nome";
                                    $cliente_stmt = $conn->prepare($cliente_sql);
                                    $cliente_stmt->execute();
                                    $clientes = $cliente_stmt->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($clientes as $cliente) {
                                        $selected = (isset($cart_item) && $cart_item['id_cliente'] == $cliente->id_cliente) ? 'selected' : '';
                                        echo '<option value="' . $cliente->id_cliente . '" ' . $selected . '>' . $cliente->nome . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div class="mb-3">
                                <label for="id_produto" class="form-label">Produto</label>
                                <select class="form-select" id="id_produto" name="id_produto" required>
                                    <option value="">Selecione um produto</option>
                                    <?php
                                    $produto_sql = "SELECT id_produto, produto FROM produtos ORDER BY produto";
                                    $produto_stmt = $conn->prepare($produto_sql);
                                    $produto_stmt->execute();
                                    $produtos = $produto_stmt->fetchAll(PDO::FETCH_OBJ);
                                    foreach ($produtos as $produto) {
                                        $selected = (isset($cart_item) && isset($cart_item['produtos']) && in_array($produto->id_produto, array_column($cart_item['produtos'], 'id_produto'))) ? 'selected' : '';
                                        echo '<option value="' . $produto->id_produto . '" ' . $selected . '>' . $produto->produto . '</option>';
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="quantidade" class="form-label">Quantidade</label>
                                <input type="number" min="1" class="form-control" id="quantidade" name="quantidade"
                                    required
                                    value="<?php echo isset($cart_item) && isset($cart_item['produtos'][0]) ? $cart_item['produtos'][0]['quantidade'] : ''; ?>">
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="/carrinho/index.php" class="btn btn-outline-danger">
                            <i class="fas fa-arrow-left"></i> Voltar
                        </a>
                        <button form="myForm" type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Salvar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</body>

</html>