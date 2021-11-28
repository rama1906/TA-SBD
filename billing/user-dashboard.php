<?php

session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
}
if (isset($_POST['end'])) {
    $id_user  = $_SESSION['id_user'];
    $id_transaksi = $_POST['id_transaksi'];
    include "config.php";
    $sql = "UPDATE transaksi SET waktu_keluar = CURRENT_TIMESTAMP WHERE id_transaksi ='$id_transaksi'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Berhasil diakhiri')</script>";
    } else {
        echo "<script>alert('Gagal memasukkan data')</script>";
    }
}
if (isset($_POST['submit'])) {
    $id_user  = $_SESSION['id_user'];
    $id_pc = $_POST['id_pc'];
    include "config.php";
    $sql = "INSERT INTO transaksi (id_user, id_pc)VALUES ('$id_user', '$id_pc')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        echo "<script>alert('Submit berhasil')</script>";
    } else {
        echo "<script>alert('Gagal memasukkan data')</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="style.css">
    <title>Berhasil Login</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php">Dextu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="history.php">Riwayat</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">

                    <a class="nav-link" href="logout.php">Keluar</a>
                </li>
            </ul>

        </div>
    </nav>
    <?php include "config.php";
    $user = $_SESSION['id_user'];
    $pc = mysqli_query($conn, "SELECT * From transaksi where id_user ='$user' AND waktu_keluar IS NULL ");
    $data = mysqli_fetch_array($pc);
    while ($data = mysqli_fetch_array($pc)) {
        echo $data;
    }
    ?>
    <div class="container p-3 my-3 bg-dark text-white " style=" height: 500px;">

        <h3>Sesi Aktif</h3>
        <form method="POST">
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <?php
                    include "config.php";
                    $user = $_SESSION['id_user'];
                    $pc = mysqli_query($conn, "SELECT * From users where id_user ='$user' ");
                    while ($data = mysqli_fetch_array($pc)) {
                        echo "<input type='text' readonly class='form-control' id='username' value= " . $data['username'] . " ?>";
                    }
                    ?>

                </div>
            </div>




            <?php
            include 'config.php';
            $id_user = $_SESSION['id_user'];
            $sql = "SELECT  transaksi.id_transaksi, pc.nama, pc.jenis, pc.tarif, TIME(transaksi.waktu_masuk) as jam from transaksi INNER JOIN pc on transaksi.id_pc = pc.id_pc WHERE id_user = '$id_user' AND transaksi.waktu_keluar IS NULL";
            $query = mysqli_query($conn, $sql);

            while ($data = mysqli_fetch_array($query)) {
                echo "<div class='form-group row'>";
                echo " <label for='nama' class='col-sm-2 col-form-label'>ID Transaksi</label>";
                echo " <div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control' id='id_transaksi' name='id_transaksi' value= " . $data['id_transaksi'] . " ?>";
                echo " </div>";
                echo " </div>";
                echo "<div class='form-group row'>";
                echo " <label for='nama' class='col-sm-2 col-form-label'>Nama PC</label>";
                echo " <div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control' id='nama' value= " . $data['nama'] . " ?>";
                echo " </div>";
                echo " </div>";
                echo "<div class='form-group row'>";
                echo " <label for='jenis' class='col-sm-2 col-form-label'>Jenis PC</label>";
                echo " <div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control' id='jenis' value= " . $data['jenis'] . " ?>";
                echo " </div>";
                echo " </div>";

                echo "<div class='form-group row'>";
                echo "<label for='tarif' class='col-sm-2 col-form-label'>Tarif</label>";
                echo " <div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control' id='tarif' value= " . $data['tarif'] . " ?>";
                echo " </div>";
                echo " </div>";
                echo "<div class='form-group row'>";
                echo "<label for='jam' class='col-sm-2 col-form-label'>Jam Masuk</label>";
                echo " <div class='col-sm-10'>";
                echo "<input type='text' readonly class='form-control' id='jam' value= " . $data['jam'] . " ?>";
                echo " </div>";
                echo " </div>";
            }
            ?>
            <button type="submit" name="end" class="btn btn-warning mt-4 float-right">Akhiri</button>
        </form>
    </div>

    <div class="container p-3 my-3 bg-dark text-white " style=" height: 240px;">

        <h3>Mulai Sesi</h3>
        <form method="POST">
            <div class="form-group row">
                <label for="username" class="col-sm-2 col-form-label">Username</label>
                <div class="col-sm-10">
                    <?php
                    include "config.php";
                    $user = $_SESSION['id_user'];
                    $pc = mysqli_query($conn, "SELECT * From users where id_user ='$user' ");
                    while ($data = mysqli_fetch_array($pc)) {
                        echo "<input type='text' readonly class='form-control' id='username' value= " . $data['username'] . " ?>";
                    }
                    ?>

                </div>
            </div>
            <div class="form-group row">
                <label for="pc" class="col-sm-2 col-form-label">Pilih PC</label>
                <div class="col-sm-10">
                    <select class="form-control" name="id_pc" id="id_pc">
                        <option selected>-- Pilih --</option>
                        <?php include "config.php";
                        $pc = mysqli_query($conn, "SELECT *From pc");
                        while ($data = mysqli_fetch_array($pc)) {
                            echo "<option value='" . $data['id_pc'] . "'>" . $data['nama'] . " " . $data['jenis'] . " | " . $data['tarif'] . "/Jam" . "</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <button type="submit" name="submit" class="btn btn-success mt-4 float-right">Submit</button>
        </form>
    </div>
    <?php ?>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>