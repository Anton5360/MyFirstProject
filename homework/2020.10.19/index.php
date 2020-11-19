<?php
session_start();
error_reporting(E_ALL);
$fixFirstUser  = [];
$message = [];
$users = [];
$file = fopen(__DIR__ . '/storage', 'r');
if(fgets( $file) === false) {
    $_SESSION['valid'] = true;
}
while ($line = fgets($file, 1024)) {
    $message[] = json_decode(trim($line), true);
}
fclose($file);
var_dump($message);
foreach ($message as $msg) {
    $users[] = $msg['nickname'];
}
$currentUser = $users[array_key_last($users)];
$uniqueNickname = array_count_values($users);
//var_dump($uniqueNickname);
?>


<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>SendMassage</title>
</head>
<body>

<!--<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-dark border-bottom shadow-sm text-white">
    <h5 class="my-0 mr-md-auto font-weight-normal">Company name</h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-white" href="#">Features</a>
        <a class="p-2 text-white" href="#">Enterprise</a>
        <a class="p-2 text-white" href="#">Support</a>
        <a class="p-2 text-white" href="#">Pricing</a>
    </nav>
    <a class="btn btn-outline-primary" href="#">Sign up</a>
</div>-->

<form action="/homework/2020.10.19/send-message.php" method="post" class="form">
    <div class="form-group">
        <label for="nickname">Enter your nickname:</label>
        <input type="text" name="nickname" id="nickname">
    </div>
    <div class="form-group">
        <label for="email">Enter your email:</label>
        <input type="email" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="message">Enter your message:</label>
        <textarea class="form-control form-control-sm" name="message" id="message" cols="30" rows="7"></textarea>
    </div>
        <button type="submit" class="btn btn-primary ml-3">Send message</button>
</form>
<hr>
<table width="100%" class="table" border="1">
<tr>
    <th>ID</th>
    <th>Nickname</th>
    <th>Email</th>
    <th>Message</th>
</tr>
<?php foreach ($message as $msg) :?>
<tr>
    <td><?= $msg['id'] ?></td>
    <td><?= $msg['nickname'] ?></td>
    <td><?=$msg['email']?></td>
    <td><?=$msg['message']?></td>
    <?php if($uniqueNickname[$msg['nickname']] === 1) : ?>
             <td><a href="">lol</a></td>
    <?php endif; ?>
</tr>
<?php endforeach; ?>
</table>

</body>
</html>