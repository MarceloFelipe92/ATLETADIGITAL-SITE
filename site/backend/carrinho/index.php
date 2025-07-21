<?php
// backend/carrinho/index.php

// As variáveis $conn, $method, $data (para POST/PUT/DELETE) já vêm do router principal (backend/index.php).
// O cabeçalho Content-Type: application/json já é definido em headers.php.

// TRATAMENTO DO MÉTODO HTTP
try {
    switch ($method) {
        case 'GET':
            // Para GET, id_cliente virá via query param (ex: /carrinho?id_cliente=1)
            // O script 'get.php' acessará $_GET diretamente.
            include "get.php";
            break;
        case 'POST':
            // Para POST, $data deve conter id_cliente, id_produto, quantidade_a_adicionar
            include "post.php";
            break;
        case 'PUT':
            // Para PUT, $data deve conter id_cliente, id_produto, nova_quantidade_total
            include "put.php";
            break;
        case 'DELETE':
            // Para DELETE, $data deve conter id_cliente, id_produto
            include "delete.php";
            break;
        default:
            http_response_code(405); // Método não permitido
            echo json_encode(['status' => 'error', 'message' => 'Método HTTP não suportado para o recurso carrinho.']);
            break;
    }
} catch (Exception $e) {
    http_response_code(500); // Internal Server Error
    echo json_encode([
        'status' => 'error',
        'message' => 'Erro interno do servidor no recurso carrinho: ' . $e->getMessage(),
        'file' => $e->getFile(),
        'line' => $e->getLine()
    ]);
}