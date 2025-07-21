<?php
// backend/carrinho/get.php
// Este script é incluído por backend/carrinho/index.php.
// Variáveis disponíveis: $conn.
// id_cliente virá via $_GET['id_cliente'].

require_once '../headers.php'; // Inclui headers aqui também, caso este arquivo seja acessado diretamente (melhor evitar)

if ($_SERVER['REQUEST_METHOD'] === 'OPTIONS') {
    http_response_code(200);
    exit;
}

// Verifica se id_cliente foi fornecido na query string
if (isset($_GET['id_cliente']) && is_numeric($_GET['id_cliente'])) {
    $id_cliente_filter = $_GET['id_cliente'];
    $sql_where = "WHERE c.id_cliente = :id_cliente";
} else {
    // Se nenhum id_cliente for fornecido ou for 'all', retorna todos os carrinhos
    $id_cliente_filter = null;
    $sql_where = ""; // Sem filtro WHERE
}

try {
    $sql = "SELECT 
                c.id_carrinho, c.data, c.id_cliente, cli.nome AS cliente_nome, 
                rl.id_rl, rl.id_produto, rl.qtde AS quantidade_no_carrinho, p.preco,
                p.produto, p.descricao, p.id_marca, p.imagem, m.marca
            FROM 
                carrinhos AS c
            JOIN 
                clientes AS cli ON c.id_cliente = cli.id_cliente
            JOIN 
                rl_carrinho_produto AS rl ON rl.id_carrinho = c.id_carrinho
            JOIN 
                produtos AS p ON p.id_produto = rl.id_produto
            JOIN 
                marcas AS m ON m.id_marca = p.id_marca
            " . $sql_where . "
            ORDER BY c.id_carrinho, p.produto"; // Ordenar para agrupamento consistente

    $stmt = $conn->prepare($sql);
    if ($id_cliente_filter !== null) {
        $stmt->bindParam(':id_cliente', $id_cliente_filter, PDO::PARAM_INT);
    }
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_OBJ);

    $carrinhos = [];
    $global_total = 0; // Total geral de todos os carrinhos retornados

    foreach ($rows as $row) {
        $id_carrinho = $row->id_carrinho;

        // Inicializa o carrinho se ainda não existir no array
        if (!isset($carrinhos[$id_carrinho])) {
            $carrinhos[$id_carrinho] = [
                'id_carrinho' => (int)$row->id_carrinho,
                'data' => $row->data,
                'id_cliente' => (int)$row->id_cliente,
                'cliente_nome' => $row->cliente_nome,
                'produtos' => [],
                'preco_total' => 0.00,
            ];
        }

        // Adiciona o produto ao carrinho
        $carrinhos[$id_carrinho]['produtos'][] = [
            'id_rl' => (int)$row->id_rl,
            'id_produto' => (int)$row->id_produto,
            'produto' => $row->produto,
            'quantidade' => (int)$row->quantidade_no_carrinho,
            'preco' => (float)$row->preco,
            'descricao' => $row->descricao,
            'id_marca' => (int)$row->id_marca,
            'imagem' => $row->imagem,
            'marca' => $row->marca,
        ];

        // Acumula o preço total para este carrinho
        $carrinhos[$id_carrinho]['preco_total'] += (float)$row->preco * (int)$row->quantidade_no_carrinho;
    }

    // Converta para array indexado e arredonde os totais
    $data_output = array_values(array_map(function ($carrinho) {
        $carrinho['preco_total'] = (float)number_format($carrinho['preco_total'], 2, '.', '');
        // Garante que 'produtos' é um array indexado (se necessário)
        $carrinho['produtos'] = array_values($carrinho['produtos']);
        return $carrinho;
    }, $carrinhos));

    // Calcula o total geral (de todos os carrinhos retornados, se 'all')
    foreach ($data_output as $carrinho_data) {
        $global_total += $carrinho_data['preco_total'];
    }
    $global_total = (float)number_format($global_total, 2, '.', '');


    http_response_code(200);
    echo json_encode([
        'status' => 'success',
        'message' => 'Dados do carrinho encontrados.',
        'data' => [
            'items' => $data_output, // Sua interface no frontend espera um array de "carrinhos"
            'total' => $global_total // Total global dos carrinhos retornados
        ]
    ]);
} catch (PDOException $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro no banco de dados: ' . $e->getMessage()]);
} catch (Exception $e) {
    http_response_code(500);
    echo json_encode(['status' => 'error', 'message' => 'Erro interno do servidor: ' . $e->getMessage()]);
}