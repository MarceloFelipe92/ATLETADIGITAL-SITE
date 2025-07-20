<?php
// backend/carrinho/put.php
// Este script é incluído por backend/carrinho/index.php.
// Variáveis disponíveis: $conn, $data (payload JSON).

require_once '../headers.php'; // Inclui headers aqui também, caso este arquivo seja acessado diretamente (melhor evitar)

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$id_cliente = $data['id_cliente'] ?? null;
$id_produto = $data['id_produto'] ?? null;
$nova_quantidade_total = $data['quantidade'] ?? null; // Nova quantidade *total* para o item

if (empty($id_cliente) || empty($id_produto) || !is_numeric($id_cliente) || !is_numeric($id_produto) || !is_numeric($nova_quantidade_total) || $nova_quantidade_total < 0) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'Dados incompletos ou inválidos para atualizar o carrinho.']);
    exit;
}

try {
    // 1. Obter o id_carrinho para o cliente
    $sql_check_carrinho = "SELECT id_carrinho FROM carrinhos WHERE id_cliente = :id_cliente";
    $stmt_check_carrinho = $conn->prepare($sql_check_carrinho);
    $stmt_check_carrinho->bindParam(':id_cliente', $id_cliente, PDO::PARAM_INT);
    $stmt_check_carrinho->execute();
    $carrinho = $stmt_check_carrinho->fetch(PDO::FETCH_OBJ);

    if (!$carrinho) {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Carrinho não encontrado para este cliente.']);
        exit;
    }
    $id_carrinho = $carrinho->id_carrinho;

    if ($nova_quantidade_total == 0) {
        // Se a nova quantidade é 0, remove o item
        $sql_delete = "DELETE FROM rl_carrinho_produto WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
        $stmt_delete = $conn->prepare($sql_delete);
        $stmt_delete->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        $stmt_delete->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt_delete->execute();

        if ($stmt_delete->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Produto removido do carrinho.']);
        } else {
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado no carrinho para remoção.']);
        }
    } else {
        // Atualiza a quantidade do item
        $sql_update = "UPDATE rl_carrinho_produto SET qtde = :nova_quantidade WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
        $stmt_update = $conn->prepare($sql_update);
        $stmt_update->bindParam(':nova_quantidade', $nova_quantidade_total, PDO::PARAM_INT);
        $stmt_update->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
        $stmt_update->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
        $stmt_update->execute();

        if ($stmt_update->rowCount() > 0) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Quantidade do produto atualizada no carrinho.']);
        } else {
            // Se o item não foi atualizado, pode ser que não exista.
            http_response_code(404);
            echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado no carrinho para atualização.']);
        }
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro interno do servidor: ' . $e->getMessage()]);
}