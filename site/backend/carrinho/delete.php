<?php
// backend/carrinho/delete.php
// Este script é incluído por backend/carrinho/index.php.
// Variáveis disponíveis: $conn, $data (payload JSON).

require_once '../headers.php'; // Inclui headers aqui também, caso este arquivo seja acessado diretamente (melhor evitar)

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

$id_cliente = $data['id_cliente'] ?? null;
$id_produto = $data['id_produto'] ?? null;

if (empty($id_cliente) || empty($id_produto) || !is_numeric($id_cliente) || !is_numeric($id_produto)) {
    http_response_code(400);
    echo json_encode(['status' => 'error', 'message' => 'ID do cliente e/ou ID do produto ausentes ou inválidos para remoção.']);
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

    // Remove o item do carrinho
    $sql = "DELETE FROM rl_carrinho_produto WHERE id_carrinho = :id_carrinho AND id_produto = :id_produto";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id_carrinho', $id_carrinho, PDO::PARAM_INT);
    $stmt->bindParam(':id_produto', $id_produto, PDO::PARAM_INT);
    $stmt->execute();

    if ($stmt->rowCount() > 0) {
        http_response_code(200);
        echo json_encode(['status' => 'success', 'message' => 'Item removido do carrinho.']);
    } else {
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Produto não encontrado no carrinho para remoção.']);
    }
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro interno do servidor: ' . $e->getMessage()]);
}