<?php
session_start();
if ($_SESSION['valid'] === true) {
    $_SESSION['valid'] = false;
    $_SESSION['id'] = 1;
}
$nickname = $_POST['nickname'] ?? null;
$email = $_POST['email'] ?? null;
$message = $_POST['message'] ?? null;
$obsceneWords = include ('ObsceneWords.php');
foreach ($obsceneWords as $bedword) {
    if(strpos($message, $bedword) !== false) {
        exit('Текст содержит нецензурную лексику');
    }
}

if (!$nickname) {
    exit('Error... Nickname are required!');
}
if (!$email) {
    exit('Error... Email are required!');
}
if (!$message) {
    exit('Error... Message are required!');
}
$data = [
    'id' => $_SESSION['id']++,
  'nickname' => $nickname,
  'email' => $email,
  'message' => $message
];

$content  = json_encode($data) . PHP_EOL;
file_put_contents(__DIR__ . '/storage', $content, FILE_APPEND);
header('Location: /homework/2020.10.19/');
exit();