<?php
session_start();
require_once 'auth.php';
$cuser = new Auth();

if (!isset($_SESSION['userAdmin'])) {
    header('location: index.php');
    die;
} 
$cemail = $_SESSION['userAdmin'];

$data = $cuser->currentUser($cemail);

$cid = $data['id_akun'];
$cname = $data['username'];
$pass = $data['password'];
$cphoto = $data['foto'];

$fname = strtok($cname, " ");
