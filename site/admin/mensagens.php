<?php

// SE HOUVER MENSAGEM DE ERRO, EXIBIR TEXTO
if (isset($_SESSION["msg"])) {
    echo '
    <div class="alert alert-info" role="alert" style="font-size: 0.9em; padding: 15px; z-index: 9999; position: fixed; top: 10px; left: 630px; width: 300px;">
        <i class="fas fa-info-circle me-2"></i>
        ' . $_SESSION["msg"] . '
    </div>
    ';
    // APÓS EXIBIR A MENSAGEM, REMOVER ELA DA SESSÃO
    unset($_SESSION["msg"]);
}
