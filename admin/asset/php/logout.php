<?php
session_start();
unset($_SESSION['userAdmin']);
header("Location: ../../../home/page/masuk.php");
