<?php
use PHPMailer\PHPMailer\src\PHPMailer;
use PHPMailer\PHPMailer\src\Exception;

require 'vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $format = htmlspecialchars($_POST['selected_format'] ?? '');
    $name = htmlspecialchars($_POST['user_name'] ?? '');
    $phone = htmlspecialchars($_POST['user_phone'] ?? '');
    $telegram = htmlspecialchars($_POST['user_telegram'] ?? '');
    $box = htmlspecialchars($_POST['user_box'] ?? '');

    $mail = new PHPMailer(true);

    try {
        // SMTP настройки
        $mail->isSMTP();
        $mail->Host       = $_ENV['SMTP_HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['SMTP_USERNAME'];
        $mail->Password   = $_ENV['SMTP_PASSWORD'];
        $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
        $mail->Port       = $_ENV['SMTP_PORT'];

        // Отправитель и получатель
        $mail->setFrom($_ENV['MAIL_FROM'], 'Форма сайта');
        $mail->addAddress($_ENV['MAIL_TO']);

        // Контент письма
        $mail->isHTML(false);
        $mail->Subject = 'Нове замовлення з сайту';
        $mail->Body    =
            "Формат: $format\n" .
            "Ім'я: $name\n" .
            "Телефон: $phone\n" .
            "Telegram: $telegram\n" .
            "Пакет: $box";

        $mail->send();
        echo 'OK';
    } catch (Exception $e) {
        echo "Помилка: {$mail->ErrorInfo}";
    }
}




// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $format = htmlspecialchars($_POST['selected_format'] ?? '');
//     $name = htmlspecialchars($_POST['user_name'] ?? '');
//     $phone = htmlspecialchars($_POST['user_phone'] ?? '');
//     $telegram = htmlspecialchars($_POST['user_telegram'] ?? '');
//     $box = htmlspecialchars($_POST['user_box'] ?? '');

//     $to = "yourname@gmail.com"; // замени на свой Gmail
//     $subject = "Нове замовлення з сайту";
//     $headers = "From: noreply@yourdomain.com\r\n";
//     $headers .= "Content-Type: text/plain; charset=utf-8\r\n";

//     $message = "Нове замовлення:\n";
//     $message .= "Формат: $format\n";
//     $message .= "Ім'я: $name\n";
//     $message .= "Телефон: $phone\n";
//     $message .= "Telegram: $telegram\n";
//     $message .= "Пакет: $box\n";

//     // Отправка
//     if (mail($to, $subject, $message, $headers)) {
//         echo "OK"; // Можно перенаправить или показать сообщение
//     } else {
//         echo "Помилка відправки!";
//     }
// } else {
//     echo "Неправильний метод запиту";
// }
?> 