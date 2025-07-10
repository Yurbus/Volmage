<?php
// Настройки
$token = ""; // Заміни на свій токен
$chat_id = ""; // Заміни на свій chat_id

// Отримання даних з форми
$name = $_POST['user_name'] ?? 'Не вказано';
$phone = $_POST['user_phone'] ?? 'Не вказано';
$telegram = $_POST['user_telegram'] ?? 'Не вказано';
$instagram = $_POST['user_instagram'] ?? 'Не вказано';
$box = $_POST['user_box'] ?? 'Не вказано';

// Формування повідомлення
$message = "📝 <b>Нове замовлення з сайту</b>\n";
$message .= "👤 Ім'я: <b>$name</b>\n";
$message .= "📞 Телефон: <b>$phone</b>\n";
$message .= "💬 Telegram: <b>$telegram</b>\n";
$message .= "📸 Instagram: <b>$instagram</b>\n";
$message .= "📦 Пакет: <b>$box</b>";

// Відправка до Telegram
$url = "https://api.telegram.org/bot$token/sendMessage";

$response = file_get_contents($url . "?" . http_build_query([
    'chat_id' => $chat_id,
    'text' => $message,
    'parse_mode' => 'HTML'
]));

echo "OK";
?>