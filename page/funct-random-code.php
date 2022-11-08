<?php
function generateRandomString($length = 6) {
    $character = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $characterLength = strlen($character);
    $randomString = '';
    for ($i=0; $i < $length; $i++) { 
        $randomString .= $character[rand(0, $characterLength - 1)];
    }
    return $randomString;
}
?>