<?php
session_start();
require_once 'auth.php';
$cuser = new Auth();

if (!isset($_SESSION['user'])) {
    header('location: login.php');
    die;
}

$cemail = $_SESSION['user'];
// $cuserName = $_SESSION['user'];

$data = $cuser->currentUser($cemail);
// $dataN = $cuser->currentUser($cuserName);