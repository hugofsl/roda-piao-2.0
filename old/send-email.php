<?php

//Para quem vai ser enviado o email
$para = "hoopersantos@gmail.com, diegosarzi@gmail.com, rajustino@gmail.com";
//resgatar o nome digitado no formulário e  grava na variavel $nome
$nome = $_POST['nome'];
//resgatar o email digitado no formulário e  grava na variavel $nome
$email = $_POST['email'];
// //resgatar o telefone digitado no formulário e  grava na variavel $email
// $telefone = $_POST['telefone'];
// // resgatar o assunto digitado no formulário e  grava na variavel $assunto
// $assunto = $_POST['assunto'];
$assunto = "Site Roda Piao - Formulario";
// resgatar a mensagem digitada no formulário e  grava na variavel $mensagem
$mensagem = $_POST['mensagem'];

// mensagem que vai ser enviado no e-mail
$body = " Nome: " . $nome . " <br>" . " Email: " . $email . " <br>" . " Mensagem: " . $mensagem;

// headers.
$headers =  "Content-Type:text/html; charset=UTF-8\n";
$headers .= "From:  estudiorodapiao.com.br<contato@estudiorodapiao.com.br>\n";
$headers .= "X-Mailer: PHP  v" . phpversion() . "\n";
$headers .= "MIME-Version: 1.0\n";

$enviaremail = mail($para, $assunto, $body, $headers);  //função que faz o envio do email.

if ($enviaremail) {
    // exibe o alert de que foi enviado
    echo '<script>alert("Email sent successfully!")</script>';
    echo '<script>window.location.replace("https://estudiorodapiao.com.br/")</script>';

    // redireciona
} else {
    // exibe o alert de que não foi enviado caso a função mail() tenha retornado erro
    echo '<script>alert("Email was not sent, please try again later.!")</script>';
}
