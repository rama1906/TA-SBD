<?php

session_start();
include "config.php";
if (!isset($_SESSION['id_admin'])) {
    header("Location: login-admin.php");
}
if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);
    $cpassword = md5($_POST['cpassword']);
    $id_member = $_POST['id_member'];

    if ($password == $cpassword) {
        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        if (!$result->num_rows > 0) {
            $sql = "INSERT INTO users (username, id_member, password)
                    VALUES ('$username', '$id_member', '$password')";
            $result = mysqli_query($conn, $sql);
            if ($result) {
                echo "<script>alert('Selamat, registrasi berhasil!')</script>";
                $username = "";
                $_POST['password'] = "";
                $_POST['cpassword'] = "";
            } else {
                echo "<script>alert('Woops! Terjadi kesalahan.')</script>";
            }
        } else {
            echo "<script>alert('Woops! username Sudah Terdaftar.')</script>";
        }
    } else {
        echo "<script>alert('Password Tidak Sesuai')</script>";
    }
}

?>

<!doctype html>
<html>

<head>
    <title>Tambah data user</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="login-admin.php">Admin Dextu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item ">
                    <a class="nav-link" href="login-admin.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="admin-history.php">Riwayat</a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="admin-list.php">Daftar User</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><?php echo  'Admin' ?></a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="card">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h3 class="card-title text-center">Tambah Data User</h3>
                            <form class="form-signing" action="" method="post">

                                <label>Username</label>
                                <div class="form-label-group">
                                    <input type="text" name="username" placeholder="Username" class="form-control" required>
                                </div><br>
                                <label>Password</label>
                                <div class="form-label-group">
                                    <input type="password" name="password" placeholder="Password" class="form-control" required>
                                </div><br>
                                <label>Konfirmasi Password</label>
                                <div class="form-label-group">
                                    <input type="password" name="cpassword" placeholder="Password" class="form-control" required>
                                </div><br>
                                <label>Member</label>
                                <div class="form-label-group">
                                    <select class="form-control" name="id_member" id="id_member">
                                        <option selected>-- Pilih --</option>
                                        <?php include "config.php";
                                        $member = mysqli_query($conn, "SELECT *From member");
                                        while ($data = mysqli_fetch_array($member)) {
                                            echo "<option value='" . $data['id_member'] . "'>" . $data['level'] . " " . $data['nama'] .  "</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                <br>
                                <input class="btn btn-success btn-block " type="submit" name="submit" value="Simpan">
                                <a class="btn btn-secondary btn-block " onClick="history.go(-1);">Kembali</a>
                        </div>
                    </div>
                    </form>
                    <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
</body>

</html>