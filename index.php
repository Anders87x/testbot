<?php
require_once 'include/vendor/autoload.php';

use TelegramBot\Api\BotApi;

// Configura el token de acceso de tu bot
$telegram = new BotApi('6453602379:AAErcIb-8BsVIe8MvlJ5yPRwg9rHqZEozPk');

// Obtiene la actualización del webhook
$update = json_decode(file_get_contents('php://input'));

// Verifica si se recibió un mensaje de texto
if (isset($update->message->text)) {
    $chatId = $update->message->chat->id;

    // Comprueba si el mensaje es "Hola"
    if ($update->message->text === 'Hola') {
        // Responde con "Hola"
        $telegram->sendMessage($chatId,'Hola, ¿en qué puedo ayudarte?');
    }
}
?>