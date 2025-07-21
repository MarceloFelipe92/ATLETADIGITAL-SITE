<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "../verificar-autenticacao.php";

// INDICA QUAL PÁGINA ESTOU NAVEGANDO
$pagina = "contatos";

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Formulario de Contatos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/admin-style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="../style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
</head>

<body style="background-color:rgba(179, 248, 225, 0.2);">

    <?php
    include "../mensagens.php";
    include "../navbar.php";
    ?>

    <div class="form-container mt-5">
        <div class="card shadow-lg p-4">
            <h2 class="mb-4 text-dark"><i class="fas fa-envelope me-2"></i> Formulário de Contato</h2>
            <hr>
            <form method="POST" enctype="multipart/form-data" action="enviar-contato.php">
                <div class="mb-3">
                    <label for="nome" class="form-label">Nome</label>
                    <input type="text" name="nome" id="nome" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>

                <div class="mb-3">
                    <label for="whatsapp" class="form-label">Whatsapp</label>
                    <input type="text" name="whatsapp" id="whatsapp" class="form-control" data-mask="(00) 00000-0000"
                        required>
                </div>

                <div class="mb-3">
                    <label for="mensagem" class="form-label">Mensagem</label>
                    <textarea class="form-control" id="mensagem" name="mensagem" rows="4" required></textarea>
                </div>

                <button type="submit" class="btn btn-outline-success shadow-sm">
                    <i class="fas fa-save me-2"></i>Enviar
                </button>
            </form>
        </div>
    </div>

    <script>
    $(document).ready(function() {
        $('#whatsapp').mask('(00) 00000-0000');
    });
    </script>

</body>

</html>