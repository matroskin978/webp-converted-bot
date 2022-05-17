<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/funcs.php';

$telegram = new \Telegram\Bot\Api(TOKEN);
$updates = $telegram->getWebhookUpdates();

//log_updates($updates);

$chat_id = $updates['message']['chat']['id'] ?? '';
$text = $updates['message']['text'] ?? '';
if (isset($updates['message']['photo'])) {
    $key = count($updates['message']['photo']) - 1;
    $file_id = $updates['message']['photo'][$key]['file_id'];
}

if ($text == '/start') {

    $res = $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => "Привет! Я - бот-конвертер. Я умею конверировать изображения из форматов JPG или PNG в формат WebP. Просто пришлите мне изображение нужного формата, и я отправлю в ответ то же изображение в формате WebP.",
    ]);

} elseif (isset($file_id)) {

    $file = $telegram->getFile([
        'file_id' => $file_id,
    ]);

    //$file_url = "https://api.telegram.org/file/bot" . TOKEN . "/{$file['file_path']}";

    $res = $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => json_encode($file, JSON_PRETTY_PRINT),
    ]);

} else {

    $res = $telegram->sendMessage([
        'chat_id' => $chat_id,
        'text' => $text,
    ]);

}
