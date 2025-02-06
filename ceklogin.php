<?php
session_start(); // Memulai session
$conn = mysqli_connect("localhost", "root", "", "laundry");
$username = mysqli_real_escape_string($conn, $_POST['username']);
$password = mysqli_real_escape_string($conn, $_POST['password']);
$result = mysqli_query($conn, "SELECT * FROM tb_user WHERE username = '$username'");
// $password =  password_verify($_POST['password']);
// $query = "SELECT * FROM tb_user WHERE username = '$username' AND password = '$password'";
$cek = mysqli_num_rows($result);
if ($cek > 0) {
    $data = mysqli_fetch_assoc($result);
    if (password_verify($password, $data['password'])) {
        if ($data['role'] == 'admin') {
            $_SESSION['role'] = 'admin';
            $_SESSION['username'] = $data['username'];
            $_SESSION['id_outlet'] = $data['id_outlet'];
            $_SESSION['id_user'] = $data['id_user'];
            header('location: admin');
            exit();
        } elseif ($data['role'] == 'kasir') {
            $_SESSION['role'] = 'kasir';
            $_SESSION['username'] = $data['username'];
            $_SESSION['id_outlet'] = $data['id_outlet'];
            $_SESSION['id_user'] = $data['id_user'];
            header('location: kasir');
            exit();
        } elseif ($data['role'] == 'owner') {
            $_SESSION['role'] = 'owner';
            $_SESSION['username'] = $data['username'];
            $_SESSION['id_outlet'] = $data['id_outlet'];
            $_SESSION['id_user'] = $data['id_user'];
            header('location: owner');
            exit();
        } else {
            $msg = 'Role not Recognized';
            header('location: index.php?msg=' . $msg);
        }
    } else {
        $msg = 'Password Incorrect';
        header('location: index.php?msg=' . $msg);
    }
} else {
    $msg = 'Username or Password Incorrect';
    header('location: index.php?msg=' . $msg);
}
