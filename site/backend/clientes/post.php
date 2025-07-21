<?php
// Define os cabeçalhos para permitir CORS (Cross-Origin Resource Sharing)
// Isso é crucial para que seu frontend Next.js (rodando em outra porta/domínio) possa se comunicar com seu backend PHP.
// EM PRODUÇÃO: Altere '*' para o domínio específico do seu frontend (ex: 'http://seusite.com.br')
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST, GET, OPTIONS, PUT, DELETE"); // Adicione todos os métodos que você pretende usar
header("Access-Control-Allow-Headers: Content-Type, Authorization"); // Permite cabeçalhos comuns

// Se for uma requisição OPTIONS (preflight), apenas retorne 200 OK
if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit();
}

// Define que a resposta será no formato JSON
header("Content-Type: application/json");

// Configurações do banco de dados
$servername = "localhost";
$username = "root"; // Seu usuário do banco de dados (geralmente 'root' para XAMPP)
$password = ""; // Sua senha do banco de dados (geralmente vazia para XAMPP)
$dbname = "db_backend"; // O nome do seu banco de dados

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica a conexão
if ($conn->connect_error) {
    // Se a conexão falhar, retorna um erro 500 (Internal Server Error)
    echo json_encode(["message" => "Erro de conexão com o banco de dados: " . $conn->connect_error]);
    http_response_code(500);
    exit();
}

// Verifica se a requisição é um POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Coleta os dados do POST
    $nome = $_POST['nome'] ?? '';
    $cpf = $_POST['cpf'] ?? '';
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $whatsapp = $_POST['whatsapp'] ?? '';
    $cep = $_POST['cep'] ?? '';
    $logradouro = $_POST['logradouro'] ?? '';
    $numero = $_POST['numero'] ?? '';
    $complemento = $_POST['complemento'] ?? '';
    $bairro = $_POST['bairro'] ?? '';
    $cidade = $_POST['cidade'] ?? '';
    $estado = $_POST['estado'] ?? '';

    // --- Validação básica dos dados ---
    if (empty($nome) || empty($cpf) || empty($email) || empty($senha)) {
        echo json_encode(["message" => "Campos obrigatórios (Nome, CPF, Email, Senha) não podem estar vazios."]);
        http_response_code(400); // Bad Request
        exit();
    }

    // --- Hash da senha ---
    // É ALTAMENTE recomendado usar password_hash() e password_verify() em produção
    // sha1() é usado aqui porque você mencionou que já o utilizava.
    $senha_hash = sha1($senha);

    // --- Tratamento da imagem ---
    $imagem_nome = null; // Inicializa com null
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $target_dir = "imagens/"; // Pasta de destino para as imagens (dentro de htdocs/clientes/)
        // Garante que o diretório de destino existe
        if (!is_dir($target_dir)) {
            mkdir($target_dir, 0777, true);
        }

        $imageFileType = strtolower(pathinfo($_FILES["imagem"]["name"], PATHINFO_EXTENSION));
        // Gera um nome único para a imagem para evitar conflitos
        $imagem_nome = uniqid('cliente_', true) . "." . $imageFileType;
        $target_file = $target_dir . $imagem_nome;

        // Move o arquivo temporário para o destino final
        if (!move_uploaded_file($_FILES["imagem"]["tmp_name"], $target_file)) {
            echo json_encode(["message" => "Erro ao fazer upload da imagem. Verifique permissões da pasta: " . $target_dir]);
            http_response_code(500); // Internal Server Error
            exit();
        }
    }

    // --- Preparar e Executar a Inserção no Banco de Dados ---
    // Certifique-se de que a ordem das colunas e dos placeholders (?) corresponda aos bind_param
    $sql = "INSERT INTO clientes (nome, cpf, email, senha, whatsapp, imagem, cep, logradouro, numero, complemento, bairro, cidade, estado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);

    // Verifica se a preparação da query falhou
    if ($stmt === false) {
        echo json_encode(["message" => "Erro ao preparar a declaração SQL: " . $conn->error]);
        http_response_code(500);
        exit();
    }

    // Vincula os parâmetros à declaração preparada
    // "sssssssssssss" -> 13 strings (s)
    $stmt->bind_param("sssssssssssss", $nome, $cpf, $email, $senha_hash, $whatsapp, $imagem_nome, $cep, $logradouro, $numero, $complemento, $bairro, $cidade, $estado);

    // Executa a declaração
    if ($stmt->execute()) {
        // Sucesso! Retorna a mensagem e o ID do novo cliente
        echo json_encode(["message" => "Cliente cadastrado com sucesso!", "id" => $conn->insert_id]);
        http_response_code(201); // 201 Created
    } else {
        // Erro na execução da query
        echo json_encode(["message" => "Erro ao cadastrar cliente: " . $stmt->error]);
        http_response_code(500); // Internal Server Error
    }

    // Fecha a declaração
    $stmt->close();
} else {
    // Se o método da requisição não for POST
    echo json_encode(["message" => "Método não permitido."]);
    http_response_code(405); // Method Not Allowed
}

// Fecha a conexão com o banco de dados
$conn->close();