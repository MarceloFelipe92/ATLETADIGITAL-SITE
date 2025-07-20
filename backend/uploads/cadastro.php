<?php
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json");

// Conexão com banco
require_once("conexao.php");

try {
    // Verifica se o método é POST
    if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
        http_response_code(405);
        throw new Exception("Método não permitido");
    }

    // Campos do formulário
    $nome = $_POST['nome'] ?? null;
    $cpf = $_POST['cpf'] ?? null;
    $email = $_POST['email'] ?? null;
    $senha = isset($_POST['senha']) ? sha1($_POST['senha']) : null;
    $whatsapp = $_POST['whatsapp'] ?? null;
    $cep = $_POST['cep'] ?? null;
    $logradouro = $_POST['logradouro'] ?? null;
    $numero = $_POST['numero'] ?? null;
    $complemento = $_POST['complemento'] ?? null;
    $bairro = $_POST['bairro'] ?? null;
    $cidade = $_POST['cidade'] ?? null;
    $estado = $_POST['estado'] ?? null;

    // Validação básica
    if (empty($nome) || empty($email) || empty($senha)) {
        http_response_code(400);
        throw new Exception("Nome, email e senha são obrigatórios.");
    }

    // Processar upload da imagem
    $imagemPath = null;
    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = __DIR__ . '/uploads/'; // Pasta para salvar imagens
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0755, true); // Cria pasta se não existir
        }

        $tmpName = $_FILES['imagem']['tmp_name'];
        $originalName = basename($_FILES['imagem']['name']);
        $ext = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));

        // Permitir só alguns tipos
        $allowed = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($ext, $allowed)) {
            throw new Exception("Tipo de arquivo não permitido. Use JPG, PNG ou GIF.");
        }

        // Novo nome para evitar conflitos
        $newName = uniqid('img_') . '.' . $ext;
        $destination = $uploadDir . $newName;

        if (!move_uploaded_file($tmpName, $destination)) {
            throw new Exception("Falha ao salvar a imagem.");
        }

        // Salva caminho relativo para banco (ajuste conforme sua estrutura)
        $imagemPath = 'uploads/' . $newName;
    }

    // SQL para inserir cliente
    $sql = "
        INSERT INTO clientes (
            nome, cpf, email, senha, whatsapp, cep, logradouro, numero, complemento, bairro, cidade, estado, imagem
        ) VALUES (
            :nome, :cpf, :email, :senha, :whatsapp, :cep, :logradouro, :numero, :complemento, :bairro, :cidade, :estado, :imagem
        )
    ";

    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':nome', $nome);
    $stmt->bindParam(':cpf', $cpf);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':senha', $senha);
    $stmt->bindParam(':whatsapp', $whatsapp);
    $stmt->bindParam(':cep', $cep);
    $stmt->bindParam(':logradouro', $logradouro);
    $stmt->bindParam(':numero', $numero);
    $stmt->bindParam(':complemento', $complemento);
    $stmt->bindParam(':bairro', $bairro);
    $stmt->bindParam(':cidade', $cidade);
    $stmt->bindParam(':estado', $estado);
    $stmt->bindParam(':imagem', $imagemPath);

    $stmt->execute();

    echo json_encode([
        'status' => 'success',
        'message' => 'Cadastro realizado com sucesso!'
    ]);
} catch (Exception $e) {
    http_response_code(http_response_code() ?: 500);
    echo json_encode([
        'status' => 'error',
        'message' => $e->getMessage()
    ]);
} finally {
    $conn = null;
}
