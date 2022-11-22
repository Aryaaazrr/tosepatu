<?php

require_once 'config/config.php';

class Auth extends Database
{
    // User sudah ada
    public function user_exist($email)
    {
        $sql = "SELECT email FROM akun WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
    }

    // Login request
    public function login($email)
    {
        $sql = "SELECT email, password FROM akun WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // current user session
    public function currentUser($email)
    {
        $sql = "SELECT * FROM akun WHERE email = :email";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // forgot request
    public function forgot($code, $email) {
        $sql = "UPDATE akun SET code = ?, code_expire = DATE_ADD(NOW(), 
        INTERVAL 10 MINUTE) WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$code, $email]);

        return true;
    }

    // test no ajax
    public function teset($email)
    {
        $sql = "SELECT * FROM akun WHERE email = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        $row = $stmt->rowCount();
        return $row;
    }

    // generate code
    public function generateRandomString($length = 6) {
        $character = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterLength = strlen($character);
        $randomString = '';
        for ($i=0; $i < $length; $i++) { 
            $randomString .= $character[rand(0, $characterLength - 1)];
        }
        return $randomString;
    }

    // reset_pass no ajax
    public function reset_pass($email, $code) {
        $sql = "SELECT id_akun FROM akun WHERE email = ? AND code = ? AND 
        code != '' AND code_expire > NOW() AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        
        return $row;
    }

    // update pass no ajax
    public function update_pass($pass, $email) {
        $sql = "UPDATE akun SET code = '', password = ? WHERE email = ?
        AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute($pass, $email);

        return true;
    }
}
