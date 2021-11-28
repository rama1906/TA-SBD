<?php

session_start();

if (!isset($_SESSION['id_user'])) {
    header("Location: index.php");
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
                <li class="nav-item ">
                    <a class="nav-link" href="index.php">Dashboard <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="history.php">Riwayat</a>
                </li>
            </ul>
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="logout.php"><?php echo  "Keluar" ?></a>
                </li>
            </ul>

        </div>
    </nav>
    <div class="container p-3 my-3 text-white " style=" height: 240px;">

        <h3>Riwayat Transaksi</h3>
        <table class="table">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID Transaksi</th>
                    <th scope="col">PC</th>
                    <th scope="col">Jenis</th>
                    <th scope="col">Tarif</th>
                    <th scope="col">Waktu Masuk</th>
                    <th scope="col">Waktu Keluar</th>
                    <th scope="col">Durasi</th>
                    <th scope="col">Total </th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                $id_user = $_SESSION['id_user'];
                $sql = "SELECT  transaksi.id_transaksi, pc.nama, pc.jenis, pc.tarif, transaksi.waktu_masuk, transaksi.waktu_keluar, member.level, TIMESTAMPDIFF(SECOND, transaksi.waktu_masuk, transaksi.waktu_keluar ) as durasi from users INNER JOIN transaksi on users.id_user = transaksi.id_user INNER JOIN pc on transaksi.id_pc = pc.id_pc INNER JOIN member on users.id_member = member.id_member WHERE transaksi.id_user = '$id_user' AND  transaksi.waktu_keluar IS NOT NULL";
                $query = mysqli_query($conn, $sql);

                while ($data = mysqli_fetch_array($query)) {

                    echo "<tr>";

                    echo "<td>" . $data['id_transaksi'] . "</td>";
                    echo "<td>" . $data['nama'] . "</td>";
                    echo "<td>" . $data['jenis'] . "</td>";
                    echo "<td>" . "RP " . $data['tarif'] . "</td>";
                    echo "<td>" . $data['waktu_masuk'] . "</td>";
                    echo "<td>" . $data['waktu_keluar'] . "</td>";
                    echo "<td>" . $data['durasi'] / 60 . " Menit" . "</td>";
                    echo "<td>" . "RP " . number_format(((($data['durasi'] / 60) / 60) * $data['tarif']) - ((($data['durasi'] / 60) / 60) * $data['tarif']) * ($data['level'] * 0.1), 0, ",", ".")  . " " . "</td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>


    </div>

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>

</html>