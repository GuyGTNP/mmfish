<?php
require_once _DIR_ . '/linebot.php';

$bot = new Linebot();
$text = $bot->getMessageText();
$bot->reply($text);