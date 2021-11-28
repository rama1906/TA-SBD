<?php

include 'config.php';
$id_user = $_POST['id_user'];
$username = $_POST['username'];
$password = $_POST['password'];
$member = $_POST['id_member'];

if ($password == "") {

    mysqli_query($conn, "UPDATE users SET  username='$username', id_member = '$member' WHERE  id_user='$id_user'");
} else {
    $passwordEnc = md5($_POST['password']);
    mysqli_query($conn, "UPDATE users SET  username='$username', password='$passwordEnc', id_member = '$member' WHERE  id_user='$id_user'");
}
header("location:admin-list.php?pesan=update");
