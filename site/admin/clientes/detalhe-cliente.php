<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "clientes";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/clientes/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        $client = $response["data"][0];
    } else {
        $client = null;
    }
} else {
    // Se 'key' não estiver definido, inicializa $client como null para evitar erros de variável indefinida
    $client = null;
}
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <title>Cadastrar Cliente - Clientes</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color: rgba(179, 248, 225, 0.2);">

    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="form-container mt-5">
        <h1 class="text-center text-white mb-4">
            <i class="fas fa-user me-2"></i>Cadastrar Cliente
        </h1>
        <p class="text-center text-white">Preencha os campos abaixo para cadastrar um novo cliente.</p>

        <a href="../clientes/index.php" class="btn text-white btn-outline-success mb-3">
            <i class="fas fa-arrow-left me-2 text-white"></i>Voltar
        </a>
        <div class="card shadow-lg p-4">
            <form id="myForm" action="/clientes/cadastrar.php" method="POST" enctype="multipart/form-data">

                <div class="row">
                    <div class="col-md-3">
                        <div class="mb-3">
                            <label for="clientId" class="form-label">Código do Cliente</label>
                            <input type="text" class="form-control" id="clientId" name="clientId" readonly
                                value="<?php echo isset($client) ? htmlspecialchars($client["id_cliente"]) : ""; ?>">
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="mb-3">
                            <label for="clientName" class="form-label">Nome do Cliente</label>
                            <input type="text" class="form-control" id="clientName" name="clientName" required
                                value="<?php echo isset($client) ? htmlspecialchars($client["nome"]) : ""; ?>">
                        </div>
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="clientCPF" class="form-label">CPF</label>
                        <input data-mask="000.000.000-00" type="text" class="form-control" id="clientCPF"
                            name="clientCPF" required
                            value="<?php echo isset($client) ? htmlspecialchars($client["cpf"]) : ""; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="clientEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="clientEmail" name="clientEmail" required
                            value="<?php echo isset($client) ? htmlspecialchars($client["email"]) : ""; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="clientPassword" class="form-label">Senha</label>
                        <input type="password" class="form-control" id="clientPassword" name="clientPassword"
                            value="<?php echo isset($client) ? htmlspecialchars($client["senha"]) : ""; ?>">
                    </div>
                    <div class=" col-md-2">
                        <label for="clientWhatsapp" class="form-label">Whatsapp</label>
                        <input data-mask="(00) 0 0000-0000" type="text" class="form-control" id="clientWhatsapp"
                            name="clientWhatsapp" required
                            value="<?php echo isset($client) ? htmlspecialchars($client["whatsapp"]) : ""; ?>">
                    </div>
                </div>

                <hr>

                <div class="mb-3">
                    <label for="clientImage" class="form-label">Imagem</label>
                    <input type="file" class="form-control" id="clientImage" name="clientImage" accept="image/*">
                    <?php
                    if (isset($client) && isset($client["imagem"]) && !empty($client["imagem"])) { // Adicionado isset($client) e !empty() para robustez
                        echo '
                            <div class="mt-2">
                                <input type="hidden" name="currentClientImage" value="' . htmlspecialchars($client["imagem"]) . '">
                                <img width="100" src="imagens/' . htmlspecialchars($client["imagem"]) . '" alt="Imagem do Cliente">
                            </div>
                        ';
                    }
                    ?>
                </div>

                <div class="row g-3">
                    <div class="col-md-3">
                        <label for="clientCEP" class="form-label">CEP</label>
                        <input data-mask="00000-000" type="text" class="form-control" id="clientCEP" name="clientCEP"
                            required
                            value="<?php echo isset($client) && isset($client["endereco"]["cep"]) ? htmlspecialchars($client["endereco"]["cep"]) : ""; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="clientStreet" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="clientStreet" name="clientStreet" required
                            value="<?php echo isset($client) && isset($client["endereco"]["logradouro"]) ? htmlspecialchars($client["endereco"]["logradouro"]) : ""; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="clientNumber" class="form-label">Número</label>
                        <input type="text" class="form-control" id="clientNumber" name="clientNumber" required
                            value="<?php echo isset($client) && isset($client["endereco"]["numero"]) ? htmlspecialchars($client["endereco"]["numero"]) : ""; ?>">
                    </div>
                </div>

                <div class="row g-3 mt-1">
                    <div class="col-md-3">
                        <label for="clientComplement" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="clientComplement" name="clientComplement"
                            value="<?php echo isset($client) && isset($client["endereco"]["complemento"]) ? htmlspecialchars($client["endereco"]["complemento"]) : ""; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="clientNeighborhood" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="clientNeighborhood" name="clientNeighborhood"
                            required
                            value="<?php echo isset($client) && isset($client["endereco"]["bairro"]) ? htmlspecialchars($client["endereco"]["bairro"]) : ""; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="clientCity" class="form-label">Cidade</label>
                        <input readonly type="text" class="form-control" id="clientCity" name="clientCity" required
                            value="<?php echo isset($client) && isset($client["endereco"]["cidade"]) ? htmlspecialchars($client["endereco"]["cidade"]) : ""; ?>">
                    </div>
                    <div class="col-md-2">
                        <label for="clientState" class="form-label">Estado</label>
                        <input readonly type="text" maxlength="2" class="form-control" id="clientState"
                            name="clientState" required
                            value="<?php echo isset($client) && isset($client["endereco"]["estado"]) ? htmlspecialchars($client["endereco"]["estado"]) : ""; ?>">
                    </div>
                </div>
            </form>
            <div class="row g-3 mt-4">
                <div class="col-md-4">
                    <button form="myForm" type="submit" class="btn btn-outline-success w-100 shadow-sm">
                        <i class="fas fa-save me-2"></i>Salvar Cliente
                    </button>
                </div>
                <div class="col-md-4">
                    <a href="../clientes/index.php" class="btn btn-outline-secondary w-100 shadow-sm">
                        <i class="fas fa-list me-2"></i>Ver Clientes Cadastrados
                    </a>
                </div>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        // Document ready para garantir que o DOM esteja totalmente carregado antes de executar o script
        $(document).ready(function() {
            // Inicialização do jQuery Mask
            $('#clientCEP').mask('00000-000');
            $('#clientCPF').mask('000.000.000-00');
            $('#clientWhatsapp').mask('(00) 0 0000-0000');

            // Lógica do ViaCEP
            $('#clientCEP').on('blur', function() {
                var cep = $(this).val().replace(/\D/g, ''); // Remove caracteres não numéricos
                if (cep.length === 8) {
                    $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                        if (!data.erro) {
                            $('#clientStreet').val(data.logradouro);
                            $('#clientNeighborhood').val(data.bairro);
                            $('#clientCity').val(data.localidade);
                            $('#clientState').val(data.uf);
                        } else {
                            alert('CEP não encontrado.');
                            $("#clientCEP").val("");
                            $("#clientStreet").val("");
                            $("#clientNeighborhood").val("");
                            $("#clientCity").val("");
                            $("#clientState").val("");
                        }
                    }).fail(function() { // Adicionado tratamento de erro para a requisição JSON
                        alert('Erro ao buscar CEP. Verifique sua conexão ou tente novamente.');
                        $("#clientCEP").val("");
                        $("#clientStreet").val("");
                        $("#clientNeighborhood").val("");
                        $("#clientCity").val("");
                        $("#clientState").val("");
                    });
                } else if (cep.length > 0) { // Mostra alerta apenas se algo foi digitado
                    alert('Formato de CEP inválido. O CEP deve ter 8 dígitos.');
                    $("#clientCEP").val("");
                    $("#clientStreet").val("");
                    $("#clientNeighborhood").val("");
                    $("#clientCity").val("");
                    $("#clientState").val("");
                }
            });
        });
    </script>
</body>

</html>