<?php

require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/config.php';
require_once __DIR__ . '/funcs.php';

$telegram = new \Telegram\Bot\Api(TOKEN);
$updates = $telegram->getWebhookUpdates();

log_updates($updates);

