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
        $menuMessage .= "1. Informacion del Curso 1\n";
        $menuMessage .= "2. Ubicacion del local 2\n";
        $menuMessage .= "3. Enviar Temario en PDF 3\n";
        $menuMessage .= "4. Enviar Audio Explicando el curso 4\n";
        $menuMessage .= "5. Video de Introduccion 5\n";
        $menuMessage .= "6. Hablar con AnderCode 6\n";
        $menuMessage .= "7. Horario de Atencion 7\n";

        $telegram->sendMessage($chatId, $menuMessage);
    } elseif ($text === '1') {
        // Responde con el menú de opciones
        $menuMessage = "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

        $telegram->sendMessage($chatId, $menuMessage);

    } elseif ($text === '2') {
        // Define las coordenadas de latitud y longitud
        $latitude = 51.5074; // Cambia esto a la latitud deseada
        $longitude = -0.1278; // Cambia esto a la longitud deseada

        // Envia la ubicación
        $telegram->sendLocation($chatId, $latitude, $longitude);
    } elseif ($text === '3') {
        // Ruta al archivo PDF que deseas enviar
        $pdfFilePath = 'assets/test.pdf'; // Reemplaza con la ruta de tu archivo PDF

        // Envía el archivo PDF al usuario
        $telegram->sendDocument($chatId, new \CURLFile(realpath($pdfFilePath)));

        // Puedes incluir un mensaje opcional junto con el archivo PDF
        $message = "Aquí tienes el archivo PDF que solicitaste.";
        $telegram->sendMessage($chatId, $message);
    } else {
        // Si el mensaje no coincide con ningún comando, responde con un mensaje predeterminado
        $defaultMessage = "No entiendo ese comando. Puedes usar /start para iniciar o /menu para ver el menú.";
        $telegram->sendMessage($chatId, $defaultMessage);
    }
}

?>