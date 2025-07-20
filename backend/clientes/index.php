<?php
// IMPORTA O ARQUIVO DE CABEÇALHO QUE CONTÉM AS DEFINIÇÕES DE CABEÇALHO E CONFIGURAÇÕES DE ACESSO
require_once '../headers.php';

// VERIFICA O MÉTODO DA REQUISIÇÃO
if (method == 'GET') {
    include "get.php";
} elseif (method == 'POST') {
    include "post.php";
} elseif (method == 'PUT') {
    include "put.php";
} elseif (method == 'DELETE') {
    include "delete.php";
} else {
    http_response_code(405); // Método não permitido
    echo json_encode(['status' => 'error', 'message' => 'Método HTTP não suportado']);
}
