<?php
session_start();

require_once 'auth.php';
$user = new Auth();

// Handle login request 
if (isset($_POST['action']) && $_POST['action'] == 'login') {
    $email = $user->validate($_POST['email']);
    $pass = $user->validate($_POST['password']);

    if (empty($email) && empty($pass)) {
        echo $user->showMessage('danger', 'Email dan Kata Sandi wajib diisi');
        // header("Location: ../../page/login.php?error=Email dan Kata Sandi wajib diisi");
        exit();
    } else if (empty($email)) {
        echo $user->showMessage('danger', 'Email wajib diisi');
        // header("Location: ../../page/login.php?error=Email wajib diisi");
        exit();
    } else if (empty($pass)) {
        echo $user->showMessage('danger', 'Kata Sandi wajib diisi');
        // header("Location: ../../page/login.php?error=Kata Sandi wajib diisi&email=$email");
        exit();
    } else {
        $loginUser1 = $user->login($email);
        $loginUser2 = $user->loginK($email);
        if ($loginUser1 != null) {
            if (password_verify($pass, $loginUser1['password'])) {
                echo 'loginAdmin';
                $_SESSION['userAdmin'] = $email;
            } else {
                echo $user->showMessage('danger', 'Kata sandi salah');
            }
        } else if ($loginUser2 != null) {
            if (password_verify($pass, $loginUser2['password'])) {
                echo 'loginUser';
                $_SESSION['userKaryawan'] = $email;
            } else {
                echo $user->showMessage('danger', 'Kata sandi salah');
            }
        } else {
            echo $user->showMessage('danger', 'Email atau Kata Sandi Salah');
        }
    }
}

// add produk 
if (isset($_POST['action']) && $_POST['action'] == 'tambahproduk') {
    $idproduk = $user->validate($_POST['id-produk']);
    $namaproduk = $user->validate($_POST['nama-produk']);
    $hargaproduk = $user->validate($_POST['harga-produk']);

    if (empty($namaproduk) && empty($hargaproduk)) {
        echo $user->showMessage('danger', 'Nama dan harga wajib diisi');
    } elseif (empty($namaproduk)) {
        echo $user->showMessage('danger', 'Nama produk wajib diisi');
    } elseif (empty($hargaproduk)) {
        echo $user->showMessage('danger', 'Harga produk wajib diisi');
    } else {
        $addProduk = $user->tambahProduk($idProduk, $namaproduk, $hargaproduk);
        echo $user->showMessage('success', 'Data berhasil ditambahkan');
    }
}

// all tim 
if (isset($_POST['action']) && $_POST['action'] == 'fetchAllUser') {
    $output = '';
    $data = $user->fetchAllUser(2);
    // $path = '../asset/php';

    if ($data) {
        $output .= '<table>
                        <thead>
                            <tr>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Id Karyawan</th>
                                <th>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Nama Karyawan</th>
                                <th>Email</th>
                                <th>Alamat</th>
                                <th>No. Telepon</th>
                                <th></th>
                            </tr>
                        </thead>';
        foreach ($data as $row) {
            // if ($row['foto'] != ' ') {
            //     $ufoto = '../img/avatar.png';
            // } else {
            //     $ufoto = $path.$row['foto'];
            // }
            $output .= '<tbody>
                            <tr>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['id_akun'] . '</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['username'] . '</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['email'] . '</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['alamat'] . '</td>
                                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;' . $row['no_telp'] . '</td>
                                <td><i class="fa-solid fa-ellipsis-vertical"></i></td>
                            </tr>
                        </tbody>';
        }
        $output .= '</table>';
        echo $output;
    } else {
        echo 'WRong';
    }
}
