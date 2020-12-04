<?php


use zetsoft\system\kernels\ZView;

$this->csrf = false;


// Load composer
require Root.'/ventest/telegram-bot/vendor/autoload.php';

$bot_api_key  = '1210680423:AAGqATmg4p3tqKpl1eoyd0wUR2gjJQxdU2k';
$bot_username = 'zetSoftTestBot';
//$commands_paths = [
//    __DIR__ . '/Commands/',
//];
try {
    // Create Telegram API object
    $telegram = new Longman\TelegramBot\Telegram($bot_api_key, $bot_username);
    //$telegram->addCommandsPaths($commands_paths);
    // Handle telegram webhook request
    $telegram->handle();
} catch (Longman\TelegramBot\Exception\TelegramException $e) {
    // Silence is golden!
    // log telegram errors
    // echo $e->getMessage();
}
