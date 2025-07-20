<?php
// backend/carrinho/post.php
// Este script é incluído por backend/carrinho/index.php.
// Variáveis disponíveis: $conn, $data (payload JSON).

require_once '../headers.php'; // Inclui headers aqui também, caso este arquivo seja acessado diretamente (melhor evitar)

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Assume que $data já foi decodificado pelo router principal (backend/index.php)
// Se estiver testando diretamente este arquivo, pode precisar: $data = json_decode(file_get_contents('php://input'), true);

$id_cliente = $data['id_cliente'] ?? null;
$id_produto = $data['id_produto'] ?? null;
$quantidade = $data['quantidade'] ?? null; // Quantidade a *adicionar* (delta)

if (empty($id_cliente) || empty($id_produto) || !is_numeric($id_cliente) || !is_numeric($id_produto) || !is_numeric($quantidade) || $quantidade <= 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Dados incompletos ou inválidos para adicionar ao carrinho.']);
    exit;
}

try {
    // 1. Verificar/Criar o carrinho para o cliente
    $sql_check_carrinho = "SELECT id_carrinho FROM carrinhos WHERE id_cliente = :id_cliente";
    $stmt_check_carrinho = $conn->prepare($sql_check_carrinho);
    $stmt_check_carrinho->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt_check_carrinho->execute();
    $carrinho = $stmt_check_carrinho->fetch(PDO::FETCH_OBJ);

    $id_carrinho = null;
    if (!$carrinho) {
        // Se não houver carrinho, crie um novo
        $sql_insert_carrinho = "INSERT INTO carrinhos (id_cliente) VALUES (:id_cliente)";
        $stmt_insert_carrinho = $conn->prepare($sql_insert_carrinho);
        $stmt_insert_carrinho->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
        $stmt_insert_carrinho->execute();
        $id_carrinho = $conn->lastInsertId();
    } else {
        $id_carrinho = $carrinho->id_carrinho;
    }

    if (!$id_carrinho) {
        throw new Exception("Não foi possível obter ou criar um ID de carrinho.");
    }

    // 2. Obter o preço atual do produto
    $sql_preco_produto = "SELECT preco FROM produtos WHERE id_produto = :id_produto";
    $stmt_preco_produto = $conn->prepare($sql_preco_produto);
    $stmt_preco_produto->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt_preco_produto->execute();
    $produto_preco = $stmt_preco_produto->fetchColumn();

    if ($produto_preco === false) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado.']);
        exit;
    }

    // 3. Verificar se o produto já existe no rl_carrinho_produto para este carrinho
    $sql_check_item = "SELECT qtde FROM rl_carrinho_produto WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
    $stmt_check_item = $conn->prepare($sql_check_item);
    $stmt_check_item->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
    $stmt_check_item->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt_check_item->execute();
    $existing_item_qtde = $stmt_check_item->fetchColumn();

    if ($existing_item_qtde !== false) {
        // Se o item existe, atualiza a quantidade (incrementa)
        $nova_quantidade_total = $existing_item_qtde + $quantidade;
        $sql_update_item = "UPDATE rl_carrinho_produto SET qtde = :nova_quantidade WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
        $stmt_update_item = $conn->prepare($sql_update_item);
        $stmt_update_item->bindParam(':nova_quantidade', $nova_quantidade_total, PDO::PARAM_INT);
        $stmt_update_item->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        $stmt_update_item->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt_update_item->execute();

        http_response_code(200); // OK
        echo json_encode(['status' => 'success', 'message' => 'Quantidade do produto atualizada no carrinho.', 'id_carrinho' => $id_carrinho]);
    } else {
        // Se o item não existe, insere um novo
        $sql_insert_item = "INSERT INTO rl_carrinho_produto (id_carrinho, id_produto, qtde, valor) VALUES (:id_carrinho, :id_produto, :quantidade, :valor_produto)";
        $stmt_insert_item = $conn->prepare($sql_insert_item);
        $stmt_insert_item->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        $stmt_insert_item->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt_insert_item->bindParam(':quantidade', $quantidade, PDO::PARAM_INT);
        $stmt_insert_item->bindParam(':valor_produto', $produto_preco, PDO::PARAM_STR); // Use STR para FLOAT
        $stmt_insert_item->execute();

        http_response_code(201); // Created
        echo json_encode(['status' => 'success', 'message' => 'Produto adicionado ao carrinho.', 'id_carrinho' => $id_carrinho]);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro interno do servidor: ' . $e->getMessage()]);
}