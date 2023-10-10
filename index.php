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
    $text = $update->message->text;

    // Comprueba si el mensaje es "/start"
    if ($text === '/start') {
        // Responde con un mensaje de bienvenida y muestra opciones de menú
        $message = "¡Bienvenido! Soy tu bot de Telegram. Puedes usar los siguientes comandos:\n\n";
        $message .= "/start - Iniciar conversación\n";
        $message .= "/menu - Mostrar menú de opciones\n";

        $telegram->sendMessage($chatId, $message);
    } elseif ($text === '/menu') {
        // Responde con el menú de opciones
        $menuMessage = "Aquí está el menú de opciones:\n";
        $menuMessage .= "1. Opción 1\n";
        $menuMessage .= "2. Opción 2\n";
        $menuMessage .= "3. Opción 3\n";

        $telegram->sendMessage($chatId, $menuMessage);
    } else {
        // Si el mensaje no coincide con ningún comando, responde con un mensaje predeterminado
        $defaultMessage = "No entiendo ese comando. Puedes usar /start para iniciar o /menu para ver el menú.";
        $telegram->sendMessage($chatId, $defaultMessage);
    }
}

?>