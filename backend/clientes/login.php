<?php
// Define os cabeçalhos para permitir CORS
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");

// Se for uma requisição OPTIONS (preflight), apenas retorne 200 OK
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Define que a resposta será no formato JSON
header("Content-Type: application/json");

// Configurações do banco de dados
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_backend";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    echo json_encode(["message" => "Erro de conexão com o banco de dados: " . $conn->connect_error]);
    http_response_code(500);
    exit();
}

// Verifica se a requisição é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Pega o corpo da requisição JSON
    $input = file_get_contents('php://input');
    $data = json_decode($input, true); // Decodifica o JSON para um array associativo

    $email = $data['email'] ?? '';
    $senha_recebida = $data['password'] ?? ''; // <--- AGORA ESPERA 'password'

    // Validação básica
    if (empty($email) || empty($senha_recebida)) {
        echo json_encode(["message" => "Email e senha são obrigatórios."]);
        http_response_code(400); // Bad Request
        exit();
    }

    // Hash da senha recebida para comparação com a senha armazenada
    $senha_hash_recebida = sha1($senha_recebida);

    // Prepara e executa a query para buscar o cliente pelo email
    // ATENÇÃO: A coluna ID na sua tabela clientes é 'id_cliente', não 'id'.
    // Ajustado para 'id_cliente' e incluído 'nome' para o NextAuth.js.
    $sql = "SELECT id_cliente, nome, email, senha, imagem FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        echo json_encode(["message" => "Erro ao preparar a declaração SQL: " . $conn->error]);
        http_response_code(500);
        exit();
    }

    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $cliente = $result->fetch_assoc();
        // Compara o hash da senha recebida com o hash armazenado no banco
        if ($senha_hash_recebida === $cliente['senha']) {
            // Login bem-sucedido
            // Retorna a estrutura esperada pelo NextAuth.js
            echo json_encode([
                "status" => "success", // Adicionado status para o NextAuth.js
                "data" => [ // Adicionado 'data' para o NextAuth.js
                    "id_cliente" => $cliente['id_cliente'],
                    "email" => $cliente['email'],
                    "nome" => $cliente['nome'], // Adicionado nome
                    "image" => $cliente['imagem'], // Adicionado imagem
                    "role" => "cliente", // Exemplo: defina um role padrão para clientes
                    // Você pode adicionar um token JWT aqui se seu backend PHP gerar um
                    // "token" => "seu_token_jwt_aqui"
                ]
            ]);
            http_response_code(200); // OK
        } else {
            // Senha incorreta
            echo json_encode(["status" => "error", "message" => "Credenciais inválidas. Senha incorreta."]);
            http_response_code(401); // Unauthorized
        }
    } else {
        // Email não encontrado
        echo json_encode(["status" => "error", "message" => "Credenciais inválidas. Email não encontrado."]);
        http_response_code(401); // Unauthorized
    }

    $stmt->close();
} else {
    // Método não permitido
    echo json_encode(["message" => "Método não permitido."]);
    http_response_code(405); // Method Not Allowed
}

$conn->close();
