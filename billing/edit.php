<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login-admin.php");
}

?>

<!doctype html>
<html>

<head>
    <title>Sistem Basis Data</title>
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
            <ul class="navbar-nav ">
                <li class="nav-item ">
                    <a class="nav-link" href="logout.php"><?php echo  'Admin' ?></a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="card">
        <div class="container">
            <div class="row">

                <?php
                include "config.php";
                $id = $_GET['id'];
                $query_mysql = mysqli_query($conn, "SELECT  users.id_user, users.username, member.nama, member.id_member
                from users 
                INNER JOIN member on users.id_member = member.id_member where users.id_user = '$id'");

                $nomor = 1;
                while ($data = mysqli_fetch_array($query_mysql)) {
                ?>
                    <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                        <div class="card card-signin my-5">
                            <div class="card-body">
                                <h5 class="card-title text-center">Edit Data User</h5>
                                <form class="form-signing" action="updateUser.php" method="post">
                                    <div class="form-label-group">
                                        <label>ID</label>
                                        <input type="text" name="id_user" value="<?php echo $data['id_user'] ?>" class="form-control" required autofocus>
                                    </div><br>
                                    <label>Username</label>
                                    <div class="form-label-group">
                                        <input type="text" name="username" value="<?php echo $data['username'] ?>" class="form-control" required>
                                    </div><br>
                                    <label>Password</label>
                                    <div class="form-label-group">
                                        <input type="text" name="password" value="" class="form-control">
                                    </div>
                                    <label>Member</label>
                                    <div class="form-label-group">
                                        <div>
                                            <select class="form-control" name="id_member" id="id_member">
                                                <option value="<?php echo $data['id_member'] ?>" selected><?php echo $data['nama'] ?></option>
                                                <?php include "config.php";
                                                $mb = mysqli_query($conn, "SELECT *From member");
                                                while ($data = mysqli_fetch_array($mb)) {
                                                    echo "<option value='" . $data['id_member'] . "'>" . $data['level'] . " " . $data['nama'] .  "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
                                    <br>
                                    <input class="btn btn-warning btn-block " type="submit" value="Simpan">
                                    <a class="btn btn-secondary btn-block " onClick="history.go(-1);">Kembali</a>


                                </form>
                            </div>
                        </div>
                    </div>
                <?php } ?>
            </div>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
</body>

</html>