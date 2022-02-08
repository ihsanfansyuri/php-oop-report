<?php
include('database.php');
$db = new Database();

$username = $_POST['username'];
$password = $_POST['password'];

if (empty($username) or empty($password)) {
    echo "<script>alert('Masukkan username atau password'); history.go(-1);</script>";
}

else {
    $password = sha1($password);
    $sql = "SELECT * from pengguna where username = '$username' and password = '$password' ";
    $query = mysqli_query($db->koneksi, $sql);
    if (mysqli_num_rows($query) > 0) {
        $data = mysqli_fetch_array($query);

        session_start();
        $_SESSION['login'] = true;
        $_SESSION['username'] = $data['username'];
        $_SESSION['nama'] = $data['nama'];

        $remember = $_POST['remember'];
        
        if($remember != "") {
            $kodeacak = hash('sha256', $username);
            setcookie('login', $kodeacak, time()+3600);
        }

        header("location:tampil.php");
    } else {
        echo "<script>alert('Gagal Login, usernmae atau password salah'); history.go(-1);</script>";
    }
}
?>