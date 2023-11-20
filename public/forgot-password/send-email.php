<?php 

require __DIR__ . '/../../vendor/autoload.php'; // Carregar as dependências do Composer

use SendGrid\Mail\Mail;

function sendEmail($emailDestinatirio, $link) {
    // Configurar a chave da API do SendGrid
    $apiKey = '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';
    error_log('Passei do apikey');
    // Criar um objeto de e-mail
    $email = new Mail();
    $email->setFrom("floratrade.contato@gmail.com");
    $email->setSubject("Redefinição de senha");
    $email->addTo($emailDestinatirio);
    $email->addContent("text/plain", "Clique no link a seguir para redefinir sua senha: " . $link);

    // Inicializar o cliente SendGrid
    $sendgrid = new \SendGrid($apiKey);

    // Enviar e-mail
    try {
        $response = $sendgrid->send($email);
        error_log("Cheguei no try");

        // Verificar o código de resposta HTTP para determinar o sucesso do envio
        if ($response->statusCode() == 202) {
            error_log("Cheguei no true");
            return true;
        } else {
            error_log("Cheguei no false do status - Código: " . $response->statusCode() . ", Body: " . $response->body());
            return false;
        }
    } catch (\Exception $e) {
        error_log('Erro ao enviar e-mail: ' . $e->getMessage());
        return false;
    }
    
}

?>