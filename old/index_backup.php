<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Estudio Roda Pião</title>
</head>

<body>
    <div class="main">
        <img src="logo_rdp.png" alt="">
        <div id="formulario">
            <form method="post" action="send-email.php">
                <input type="text" name="nome" id="nome" placeholder="Nome">
                <input type="text" name="email" id="email" placeholder="Email">
                <input type="text" name="telefone" id="telefone" placeholder="Telefone">
                </br>
                <select name="assunto" id="assunto">
                    <option value="Orçamento">Orçamento</option>
                    <option value="Duvidas">Dúvidas</option>
                    <option value="Financeiro">Financeiro</option>
                    <option value="Suporte">Suporte</option>
                </select>
                </br>
                <textarea name="mensagem" id="mensagem" cols="30" rows="10" placeholder="Mensagem "></textarea>
                <input type="submit" value="Enviar" />
            </form>
        </div>
    </div>
</body>

</html>
