<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Coleta e sanitiza os dados do formulário
    $nome = htmlspecialchars(trim($_POST['nome']));
    $email = htmlspecialchars(trim($_POST['email']));
    $celular = htmlspecialchars(trim($_POST['celular']));
    $mensagem = htmlspecialchars(trim($_POST['mensagem']));

    // Verifica se os campos obrigatórios estão preenchidos
    if (empty($nome) || empty($email) || empty($mensagem)) {
        echo "Por favor, preencha todos os campos obrigatórios.";
        exit;
    }

    // Verifica se o e-mail é válido
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "Formato de e-mail inválido.";
        exit;
    }

    // Configurações do e-mail
    $destinatario = "georgecampos1997@gmail.com"; // Seu e-mail real
    $assunto = "Nova mensagem do formulário de contato";

    // Cabeçalhos para evitar spam e informar remetente
    $headers = "From: $nome <$email>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "MIME-Version: 1.0\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // Corpo do e-mail formatado
    $corpo_email = "📩 Nova mensagem do site Portfólio\n\n";
    $corpo_email .= "👤 Nome: $nome\n";
    $corpo_email .= "📧 Email: $email\n";
    $corpo_email .= "📱 Celular: $celular\n\n";
    $corpo_email .= "📝 Mensagem:\n$mensagem\n\n";
    $corpo_email .= "-----------------------------\n";
    $corpo_email .= "Enviado em: " . date('d/m/Y H:i:s') . "\n";

    // Envia o e-mail
    if (mail($destinatario, $assunto, $corpo_email, $headers)) {
        header('Location: sucesso.html'); // você pode criar uma página de sucesso
    } else {
        header('Location: erro.html'); // ou página de erro
    }
    exit;
}
