<?php
session_start();

$isGuest = !isset($_SESSION['user']);

if($isGuest) {
    require_once __DIR__ . '/views/auth-form.php';
    exit;
}