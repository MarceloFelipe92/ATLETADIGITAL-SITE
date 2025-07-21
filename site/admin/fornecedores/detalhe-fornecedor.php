<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "fornecedores";

if (isset($_GET["key"])) {
    $key = $_GET["key"];
    require("../requests/fornecedores/get.php");
    if (isset($response["data"]) && !empty($response["data"])) {
        // Se houver dados, pega o primeiro e único fornecedor na posição [0]
        $provider = $response["data"][0];
    } else {
        $provider = null;
    }
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Fornecedor - Administração</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="form-container mt-5">
        <h1 class="text-center text-white mb-4"><i class="fas fa-truck me-2"></i>Cadastro de Fornecedor</h1>
        <p class="text-center text-white">Preencha os campos abaixo para cadastrar um novo fornecedor.</p>
        <a href="../fornecedores/index.php" class="btn text-white btn-outline-success mb-2">
            <i class="fas fa-arrow-left me-2 text-white"></i>Voltar
        </a>

        <div class="card shadow-lg p-4">
            <form id="myForm" method="POST" action="/fornecedores/cadastrar.php" enctype="multipart/form-data">
                <div class="row mb-3">
                    <div class="col-md-2">
                        <label for="providerId" class="form-label">Código</label>
                        <input type="text" class="form-control" id="providerId" name="providerId" readonly
                            value="<?php echo isset($provider) ? $provider["id_fornecedor"] : ""; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="providerCNPJ" class="form-label">CNPJ</label>
                        <input data-mask="00.000.000/0000-00" type="text" class="form-control" id="providerCNPJ"
                            name="providerCNPJ" required
                            value="<?php echo isset($provider) ? $provider["cnpj"] : ""; ?>">
                    </div>
                    <div class="col-md-7">
                        <label for="providerName" class="form-label">Razão Social</label>
                        <input type="text" class="form-control" id="providerName" name="providerName" required
                            value="<?php echo isset($provider) ? $provider["razao_social"] : ""; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="providerEmail" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="providerEmail" name="providerEmail" required
                            value="<?php echo isset($provider) ? $provider["email"] : ""; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="providerPhone" class="form-label">Telefone</label>
                        <input data-mask="(00) 0000-0000" type="text" class="form-control" id="providerPhone"
                            name="providerPhone" required
                            value="<?php echo isset($provider) ? $provider["telefone"] : ""; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-3">
                        <label for="providerCEP" class="form-label">CEP</label>
                        <input data-mask="00000-000" type="text" class="form-control" id="providerCEP"
                            name="providerCEP" required
                            value="<?php echo isset($provider) ? $provider["endereco"]["cep"] : ""; ?>">
                    </div>
                    <div class="col-md-6">
                        <label for="providerStreet" class="form-label">Logradouro</label>
                        <input type="text" class="form-control" id="providerStreet" name="providerStreet" required
                            value="<?php echo isset($provider) ? $provider["endereco"]["logradouro"] : ""; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="providerNumber" class="form-label">Número</label>
                        <input type="text" class="form-control" id="providerNumber" name="providerNumber" required
                            value="<?php echo isset($provider) ? $provider["endereco"]["numero"] : ""; ?>">
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-4">
                        <label for="providerComplement" class="form-label">Complemento</label>
                        <input type="text" class="form-control" id="providerComplement" name="providerComplement"
                            value="<?php echo isset($provider) ? $provider["endereco"]["complemento"] : ""; ?>">
                    </div>
                    <div class="col-md-4">
                        <label for="providerNeighborhood" class="form-label">Bairro</label>
                        <input type="text" class="form-control" id="providerNeighborhood" name="providerNeighborhood"
                            required value="<?php echo isset($provider) ? $provider["endereco"]["bairro"] : ""; ?>">
                    </div>
                    <div class="col-md-3">
                        <label for="providerCity" class="form-label">Cidade</label>
                        <input readonly type="text" class="form-control" id="providerCity" name="providerCity" required
                            value="<?php echo isset($provider) ? $provider["endereco"]["cidade"] : ""; ?>">
                    </div>
                    <div class="col-md-1">
                        <label for="providerState" class="form-label">UF</label>
                        <input readonly maxlength="2" type="text" class="form-control" id="providerState"
                            name="providerState" required
                            value="<?php echo isset($provider) ? $provider["endereco"]["estado"] : ""; ?>">
                    </div>
                </div>
            </form>

            <div class="d-flex justify-content-between">
                <a href="/fornecedores" class="btn btn-outline-danger">
                    <i class="fas fa-arrow-left me-2"></i>Voltar
                </a>
                <button form="myForm" type="submit" class="btn btn-success">
                    <i class="fas fa-save me-2"></i>Salvar Fornecedor
                </button>
            </div>

        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <script>
        $('#providerCEP').on('blur', function() {
            var cep = $(this).val().replace(/\D/g, '');
            // Verifica se o CEP tem 8 dígitos
            if (cep.length === 8) {
                // Faz a requisição para a API ViaCEP
                $.getJSON('https://viacep.com.br/ws/' + cep + '/json/?callback=?', function(data) {
                    if (!data.erro) {
                        $('#providerStreet').val(data.logradouro);
                        $('#providerNeighborhood').val(data.bairro);
                        $('#providerCity').val(data.localidade);
                        $('#providerState').val(data.uf);
                    } else {
                        alert('CEP não encontrado.');
                        $("#providerCEP").val("");
                        $("#providerStreet").val("");
                        $("#providerNeighborhood").val("");
                        $("#providerCity").val("");
                        $("#providerState").val("");
                    }
                });
            } else {
                alert('Formato de CEP inválido.');
                // Limpa os campos de endereço
                $("#providerCEP").val("");
                $("#providerStreet").val("");
                $("#providerNeighborhood").val("");
                $("#providerCity").val("");
                $("#providerState").val("");
            }
        });
    </script>
</body>

</html>