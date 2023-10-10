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
        $message .= "/url - Ver Pagina del Curso\n";

        $telegram->sendMessage($chatId, $message);
    } elseif ($text === '/menu') {
        // Responde con el menú de opciones
        $menuMessage = "Aquí está el menú de opciones:\n";
        $menuMessage .= "1️⃣. Información del Curso. ❔\n";
        $menuMessage .= "2️⃣. Ubicación del local. 📍\n";
        $menuMessage .= "3️⃣. Enviar temario en pdf. 📄\n";
        $menuMessage .= "4️⃣. Audio explicando curso. 🎧\n";
        $menuMessage .= "5️⃣. Video de Introducción. ⏯️\n";
        $menuMessage .= "6️⃣. Hablar con AnderCode. 🙋‍♂️\n";
        $menuMessage .= "7️⃣. Horario de Atención. 🕜\n";

        $telegram->sendMessage($chatId, $menuMessage);
    } elseif ($text === '/url') {
        $keyboard = json_encode([
            "inline_keyboard" => [
                [
                    [
                        "text" => "✅ ADMINPAGE ✅",
                        "callback_data" => "callbackone"
                    ],

                    [
                        "text" => "❌ HOMEPAGE ❌",
                        "callback_data" => "callbacktwo"
                    ],

                ]
            ]
        ]);

        $telegram->sendMessage($chatId, "Prueba",null, false, null, $keyboard);
        /* $menuMessage = " https://www.udemy.com/course/whatsapp-api-con-nodejs-envio-y-recepcion-de-mensajes/?couponCode=02OCT23";

        $telegram->sendMessage($chatId, $menuMessage,'HTML'); */
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
    } elseif ($text === '4') {
        // Ruta al archivo de audio que deseas enviar
        $audioFilePath = 'assets/sample1.mp3'; // Reemplaza con la ruta de tu archivo de audio

        // Envía el archivo de audio al usuario
        $telegram->sendAudio($chatId, new \CURLFile(realpath($audioFilePath)));

        // Puedes incluir un mensaje opcional junto con el archivo de audio
        $message = "Aquí tienes el archivo de audio que solicitaste.";
        $telegram->sendMessage($chatId, $message);
    } elseif ($text === '5') {
        // Enlace al video de YouTube
        $youtubeVideoUrl = 'https://youtu.be/OL63dvaqyTY'; // Reemplaza VIDEO_ID con el ID del video de YouTube

        // Envía el enlace al video de YouTube
        $telegram->sendMessage($chatId, $youtubeVideoUrl);
    } elseif ($text === '6') {
         // Responde con el menú de opciones
         $menuMessage = "🤝 En breve me pondré en contacto contigo. 🤓";

         $telegram->sendMessage($chatId, $menuMessage);
    } elseif ($text === '7') {
        // Responde con el menú de opciones
        $menuMessage = "📅 Horario de Atención: Lunes a Viernes. \n🕜 Horario: 9:00 a.m. a 5:00 p.m. 🤓";

        $telegram->sendMessage($chatId, $menuMessage);
    } else {
        // Si el mensaje no coincide con ningún comando, responde con un mensaje predeterminado
        $defaultMessage = "No entiendo ese comando. Puedes usar /start para iniciar o /menu para ver el menú.";
        $telegram->sendMessage($chatId, $defaultMessage);
    }
}

?>