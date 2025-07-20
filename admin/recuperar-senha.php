<!-- Aqui você vai recuperar a senha do usuário -->
<<?php 
if (!session_id()) {
    session_start();
    
    //VERIFICAR SE O USUÁRIO ESTÁ AUTENTICADO   
    if (isset($_SESSION["autenticado"]) && $_SESSION["autenticado"] == true) {
        header('Location: ./index.php');
        exit;
    } 
}

?>