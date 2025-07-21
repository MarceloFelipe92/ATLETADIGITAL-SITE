<?php
session_start();
// VERIFICA SE HÁ COOKIE DE NAVEGAÇÃO DOS ACESSOS
if (
    isset($_COOKIE["email"]) &&
    isset($_COOKIE["password"]) &&
    isset($_COOKIE["remember"])
) {
    $email = $_COOKIE["email"];
    $password = $_COOKIE["password"];
    $remember = "checked";
} else {
    $email = "";
    $password = "";
    $remember = "";
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Painel Administrativo</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">

</head>

<body class="bg-success-subtle d-flex align-items-center" style="height: 100vh;">

    <?php
    include "mensagens.php";
    ?>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <i class="fas fa-user-shield fa-3x text-primary"></i>
                            <h3 class="mt-3">Painel Administrativo</h3>
                            <p class="text-muted">Faça login para acessar o sistema</p>
                        </div>

                        <form action="/validar-login.php" method="POST">
                            <div class="mb-3">
                                <label for="email" class="form-label">E-mail</label>
                                <input value="<?php echo $email; ?>" type="email" class="form-control" id="email"
                                    name="email" placeholder="Digite seu e-mail">
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Senha</label>
                                <input value="<?php echo $password; ?>" type="password" class="form-control"
                                    id="password" name="password" placeholder="Digite sua senha">
                            </div>

                            <!-- Checkbox Remember Me -->
                            <div class="mb-3 form-check">
                                <input <?php echo $remember; ?> type="checkbox" class="form-check-input" id="remember"
                                    name="remember">
                                <label class="form-check-label" for="remember">Lembrar-me</label>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-outline-primary shadow-sm">
                                    <i class="fas fa-sign-in-alt me-1"></i> Entrar
                                </button>
                            </div>
                        </form>

                        <div class="text-center mt-3">
                            <a href="recuperar-senha.php" class="text-decoration-none">Esqueceu a senha?</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Bundle JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>