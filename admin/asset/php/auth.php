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
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result;
    }

    // increment id karyawan
    public function idKaryawan()
    {
        $sql = "SELECT max(id_akun) as maxKode FROM akun";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $inc = $stmt->fetch(PDO::FETCH_ASSOC);

        $idKaryawan = $inc['maxKode'];

        $noUrut = (int) substr($idKaryawan, 8, 3);
        $noUrut++;

        $character = 'KT220921';
        $idKaryawan = $character . sprintf("%03s", $noUrut);

        return $idKaryawan;
    }

    // register request
    public function registerKaryawan($idKaryawan, $name, $email, $password, $roleKaryawan)
    {
        $sql = "INSERT INTO akun (id_akun, username, email, password, role) VALUES (?, ?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$idKaryawan, $name, $email, $password, $roleKaryawan]);
        return true;
    }

    // Login admin request
    public function login($email)
    {
        $sql = "SELECT email, password FROM akun WHERE email = :email AND deleted != 0 AND role = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // Login karyawan request
    public function loginK($email)
    {
        $sql = "SELECT email, password FROM akun WHERE email = :email AND deleted != 0 AND role = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // current user session
    public function currentUser($email)
    {
        $sql = "SELECT * FROM akun WHERE email = :email AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['email' => $email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row;
    }

    // forgot request
    public function forgot($code, $email)
    {
        $sql = "UPDATE akun SET code = ?, code_expire = DATE_ADD(NOW(), 
        INTERVAL 5 MINUTE) WHERE email = ?";
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
    public function generateRandomString($length = 6)
    {
        $character = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $characterLength = strlen($character);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $character[rand(0, $characterLength - 1)];
        }
        return $randomString;
    }

    // reset_pass no ajax
    public function reset_pass($email, $code)
    {
        $sql = "SELECT id_akun FROM akun WHERE email = ? AND code = ? AND 
        code != '' AND code_expire > NOW() AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email, $code]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        return $row;
    }

    //  check role user
    public function checkRole($email) {
        $sql = "SELECT id_akun FROM akun WHERE email = ? AND role < 3";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$email]);
        return true;
    }

    // update pass no ajax
    public function update_pass($pass, $email)
    {
        $sql = "UPDATE akun SET code = '', password = ? WHERE email = ?
        AND deleted != 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$pass, $email]);

        return true;
    }

    // count total produk layanan
    public function totalCount($tablename)
    {
        $sql = "SELECT * FROM $tablename";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->rowCount();

        return $count;
    }

    // count total toko dilihat
    public function siteHits()
    {
        $sql = "SELECT hits FROM pengunjung";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $count = $stmt->fetch(PDO::FETCH_ASSOC);

        return $count;
    }

    // add produk
    public function tambahProduk($idProduk, $namaproduk, $hargaproduk)
    {
        $sql = "INSERT INTO layanan (id_layanan, nama_layanan, harga_layanan) VALUE (:id-produk, :nama-produk, :harga-produk)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute(['id-produk' => $idProduk, 'nama-produk' => $namaproduk, 'harga-produk' => $hargaproduk]);
        return true;
    }

    // id produk custom
    public function idProdukIncrement()
    {
        $sql = "SELECT max(id_layanan) as maxKode FROM layanan";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $inc = $stmt->fetch(PDO::FETCH_ASSOC);

        $idProduk = $inc['maxKode'];

        $noUrut = (int) substr($idProduk, 8, 3);
        $noUrut++;

        $character = 'TL220921';
        $idProduk = $character . sprintf("%03s", $noUrut);

        echo $idProduk;
    }

    public function bulan($bulan)
    {
        switch ($bulan) {
            case 1:
                $bulan = "Januari";
                break;
            case 2:
                $bulan = "Februari";
                break;
            case 3:
                $bulan = "Maret";
                break;
            case 4:
                $bulan = "April";
                break;
            case 5:
                $bulan = "Mei";
                break;
            case 6:
                $bulan = "Juni";
                break;
            case 7:
                $bulan = "Juli";
                break;
            case 8:
                $bulan = "Agustus";
                break;
            case 9:
                $bulan = "September";
                break;
            case 10:
                $bulan = "Oktober";
                break;
            case 11:
                $bulan = "November";
                break;
            case 12:
                $bulan = "Desember";
                break;
        }
        return $bulan;
    }

    public function fetchAllUser($val)
    {
        $sql = "SELECT id_akun, username, email, alamat, no_telp FROM akun WHERE role = $val";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }
}
