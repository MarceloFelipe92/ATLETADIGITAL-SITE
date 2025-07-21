<?php
// CHAMA O ARQUIVO ABAIXO NESTA TELA
include "verificar-autenticacao.php";

// VERIFICA SE ESTA VINDO IMFORMAÇÕES 
if ($_POST) {
    // CAPTURA OS DADOS DO FORMULÁRIO
    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $whatsapp = $_POST["whatsapp"];
    $mensagem = $_POST["mensagem"];

    // MONTA O CORPO DO E-MAIL
  $corpo = "
  <strong>Nome : </strong> $nome <br>
  <strong>E-mail : </strong> $email <br>
  <strong>Whatsapp : </strong> $whatsapp <br>
  <strong>Mensagem : </strong> $mensagem <br>
  ";

  // mail("marcelo.fpsantos@senac.com.br","Formulário de Contato",$corpo);   / ENVIA O E-MAIL
  
  // ENVIA O E-MAIL
    require("PHPMailer/src/PHPMailer.php"); 
    require("PHPMailer/src/SMTP.php"); 
    $mail = new PHPMailer\PHPMailer\PHPMailer(); 
    $mail->CharSet = "UTF-8"; // Habilita Acentuação
    $mail->IsSMTP(); // enable SMTP 
    $mail->SMTPDebug = 0; // debugging: 1 = errors and messages, 2 = messages only 
    $mail->SMTPAuth = true; // authentication enabled 
    $mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail 
    $mail->Host = "mail.g1a.com.br"; 
    $mail->Port = 465; // or 587 
    $mail->IsHTML(true); 
    $mail->Username = "alunos@g1a.com.br"; 
    $mail->Password = "Alunos@2025"; 
    $mail->SetFrom("alunos@g1a.com.br"); 
    $mail->Subject = "Formulário de Contato"; 
    $mail->Body = $corpo; 
    $mail->AddAddress("marcel_of_@hotmail.com"); 
    if(!$mail->Send()) { 
    $_SESSION ["msg"] = "Mailer Error: " . $mail->ErrorInfo; 
    } else { 
    $_SESSION ["msg"]= "Mensagem enviada com sucesso"; 
    } 
}
// REDIRECIONA PARA A PÁGINA DE CONTATO
header("Location: href=". $_SESSION["url"] . "../contatos/formulario-contato.php");