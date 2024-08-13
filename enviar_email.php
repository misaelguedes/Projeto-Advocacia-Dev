<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Configurações do e-mail
    $to = "misaelguedes17@gmail.com";
    $subject = "Nova mensagem do site";
    
    // Coletar dados do formulário
    $name = strip_tags(trim($_POST["nome"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $message = trim($_POST["mensagem"]);

    // Validar campos
    if (empty($name) || !filter_var($email, FILTER_VALIDATE_EMAIL) || empty($message)) {
        http_response_code(400);
        echo "Por favor, preencha o formulário corretamente.";
        exit;
    }

    // Corpo do e-mail
    $email_content = "Nome: $name\n";
    $email_content = "Email: $email\n";
    $email_content = "Mensagem:\n$message\n";

    // Enviar o e-mail
    $success = mail($to, $subject, $email_content);

    // Feedback
    if ($success) {
        http_response_code(200);
        echo "Obrigado! Sua mensagem foi enviada com sucesso.";
    } else {
        http_response_code(500);
        echo "Ocorreu um erro. Tente novamente mais tarde.";
    }
} else {
    http_response_code(403);
    echo "O formulário deve ser submetido corretamente.";
}
?>
