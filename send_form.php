<?php
// use PHPMailer\PHPMailer\src\PHPMailer;
// use PHPMailer\PHPMailer\src\Exception;

// // require 'vendor/autoload.php';

// $dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
// $dotenv->load();

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $format = htmlspecialchars($_POST['selected_format'] ?? '');
//     $name = htmlspecialchars($_POST['user_name'] ?? '');
//     $phone = htmlspecialchars($_POST['user_phone'] ?? '');
//     $telegram = htmlspecialchars($_POST['user_telegram'] ?? '');
//     $box = htmlspecialchars($_POST['user_box'] ?? '');

//     $mail = new PHPMailer(true);

//     try {
//         // SMTP настройки
//         $mail->isSMTP();
//         $mail->Host       = $_ENV['SMTP_HOST'];
//         $mail->SMTPAuth   = true;
//         $mail->Username   = $_ENV['SMTP_USERNAME'];
//         $mail->Password   = $_ENV['SMTP_PASSWORD'];
//         $mail->SMTPSecure = $_ENV['SMTP_SECURE'];
//         $mail->Port       = $_ENV['SMTP_PORT'];

//         // Отправитель и получатель
//         $mail->setFrom($_ENV['MAIL_FROM'], 'Форма сайта');
//         $mail->addAddress($_ENV['MAIL_TO']);

//         // Контент письма
//         $mail->isHTML(false);
//         $mail->Subject = 'Нове замовлення з сайту';
//         $mail->Body    =
//             "Формат: $format\n" .
//             "Ім'я: $name\n" .
//             "Телефон: $phone\n" .
//             "Telegram: $telegram\n" .
//             "Пакет: $box";

//         $mail->send();
//         echo 'OK';
//     } catch (Exception $e) {
//         echo "Помилка: {$mail->ErrorInfo}";
//     }
    
// }
    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // 1. Проверка reCAPTCHA
        $recaptchaToken = $_POST['g-recaptcha-response'];
        $secretKey = '';

        $verifyUrl = 'https://www.google.com/recaptcha/api/siteverify';
        $data = [
            'secret' => $secretKey,
            'response' => $recaptchaToken
        ];

        $options = [
            'http' => [
                'header'  => "Content-type: application/x-www-form-urlencoded\r\n",
                'method'  => 'POST',
                'content' => http_build_query($data)
            ]
        ];

        $context  = stream_context_create($options);
        $response = file_get_contents($verifyUrl, false, $context);
        $result = json_decode($response);

        if ($result->success && $result->score >= 0.5) {
            // 2. Валидация и отправка формы
            $name = htmlspecialchars($_POST['user_name']);
            $phone = htmlspecialchars($_POST['user_phone']);
            $telegram = htmlspecialchars($_POST['user_telegram']);
            $instagram = htmlspecialchars($_POST['user_instagram']);
            $box = htmlspecialchars($_POST['user_box']);

            $to = 'your@email.com';
            $subject = 'Нове замовлення';
            $message = "Ім'я: $name\nТелефон: $phone\nTelegram: $telegram\nInstagram: $instagram\nПакет: $box";
            $headers = "From: no-reply@volmage.academy\r\n";

            mail($to, $subject, $message, $headers);

            echo "OK"; // или сделай редирект, или JSON
        } else {
            echo "Помилка: reCAPTCHA не пройдена.";
        }
    }

    // if ($_SERVER["REQUEST_METHOD"] === "POST") {
    //     $name     = htmlspecialchars($_POST['user_name'] ?? '');
    //     $phone    = htmlspecialchars($_POST['user_phone'] ?? '');
    //     $telegram = htmlspecialchars($_POST['user_telegram'] ?? '');
    //     $instagram = htmlspecialchars($_POST['user_instagram'] ?? '');
    //     $box      = htmlspecialchars($_POST['user_box'] ?? '');
    
    //     $to      = "volmage@volmage.webtest.in.ua"; // 🔁 замени на свой Gmail
    //     $subject = "Нове замовлення з сайту";
    //     $headers = "From: noreply@volmage.webtest.in.ua\r\n";
    //     $headers .= "Content-Type: text/plain; charset=utf-8\r\n";
    
    //     $message =
    //         "Ім'я: $name\n" .
    //         "Телефон: $phone\n" .
    //         "Telegram: $telegram\n" .
    //         "Інстаграм: $instagram\n" .
    //         "Пакет: $box";
    
    //     if (mail($to, $subject, $message, $headers)) {
    //         echo "OK";
    //     } else {
    //         echo "Помилка відправки!";
    //     }
    // } else {
    //     echo "Невірний метод запиту";
    // }
    
?> 