<?php
// Define as configurações de cabeçalho para permitir o acesso à API
header('Access-Control-Allow-Origin: *'); // Permite acesso de qualquer origem
header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS'); // Métodos permitidos
header('Access-Control-Allow-Headers: Content-Type, Authorization'); // Cabeçalhos permitidos
header('Access-Control-Allow-Credentials: true'); // Permite credenciais
header('Content-Type: application/json; charset=utf-8'); // Define o tipo de conteúdo como JSON

// Lida com as requisições OPTIONS (preflight requests) que os navegadores fazem para CORS
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Configurações de conexão com o banco de dados
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', ''); // senha vazia
define('DB_NAME', 'db_backend');

try {
    // Cria a conexão PDO
    $conn = new PDO("mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8", DB_USER, DB_PASS);

    // Configura o PDO para lançar exceções em erros
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Configura o fetch padrão para arrays associativos
    $conn->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    // Desativa a emulação de prepared statements
    $conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
} catch (PDOException $e) {
    // Em caso de erro, retorna JSON com o erro
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro de conexão com o banco de dados: ' . $e->getMessage()]);
    exit;
}
