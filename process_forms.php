<?php
// Функция для очистки входных данных
function clean_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Обработка формы "Заказать звонок"
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['call_request'])) {
    $name = clean_input($_POST["name"]);
    $tel = clean_input($_POST["tel"]);
    
    // Отправка уведомления на email
    $to = "stroitrans102@yandex.ru";
    $subject = "Новый запрос на звонок";
    $message = "Имя: $name\nТелефон: $tel";
    $headers = "From: webmaster@example.com";
    
    mail($to, $subject, $message, $headers);
    
    echo "Спасибо! Мы свяжемся с вами в ближайшее время.";
}

// Обработка формы отзыва
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['review'])) {
    $uname = clean_input($_POST["uname"]);
    $email = clean_input($_POST["email"]);
    $msg = clean_input($_POST["msg"]);
    
    // Отправка уведомления на email
    $to = "stroitrans102@yandex.ru";
    $subject = "Новый отзыв";
    $message = "Имя: $uname\nEmail: $email\nСообщение: $msg";
    $headers = "From: $email";
    
    mail($to, $subject, $message, $headers);
    
    echo "Спасибо за ваш отзыв!";
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['call_request'])) {
        $response = "Спасибо! Мы свяжемся с вами в ближайшее время.";
    } elseif (isset($_POST['review'])) {
        $response = "Спасибо за ваш отзыв!";
    }
    
    // Перенаправление обратно на главную страницу с параметром
    header("Location: index.html?message=" . urlencode($response));
    exit();
}
?>