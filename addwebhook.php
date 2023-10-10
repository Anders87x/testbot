<?php

// Token de acceso de tu bot
$botToken = '6453602379:AAErcIb-8BsVIe8MvlJ5yPRwg9rHqZEozPk';

// URL de tu webhook
$webhookUrl = 'https://andercode.net/index.php'; // Reemplaza esto con tu URL de webhook

// Configura el webhook mediante una solicitud HTTP
$apiUrl = "https://api.telegram.org/bot$botToken/setWebhook?url=$webhookUrl";
$response = file_get_contents($apiUrl);

// Verifica si la configuración del webhook fue exitosa
if ($response === false) {
    // Captura el error si la solicitud HTTP falla
    $error = error_get_last();
    echo "Error al configurar el webhook: " . $error['message'];
} else {
    // Verifica la respuesta de Telegram
    $responseData = json_decode($response, true);
    if ($responseData['ok'] === true) {
        echo "Webhook configurado con éxito.";
    } else {
        echo "Error al configurar el webhook: " . $responseData['description'];
    }
}

?>