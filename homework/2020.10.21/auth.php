<?php
error_reporting(E_ALL);

$userLogin = $_POST['login'] ?? null;
$userPassword = $_POST['password'] ?? null;

if(!$userLogin || !$userPassword){
    exit('Login and password are required!');
}

$config = require_once __DIR__ . '/config.php';
$users = $config['users'];

$password =  $users[$userLogin] ?? null;

if(!$password || $password !== $userPassword){
    exit('Login or password entered incorrectly!');
}
session_start();
$_SESSION['user'] = $userLogin;

header('Location: index.php');