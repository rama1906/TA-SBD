<?php
include 'config.php';
$id = $_GET['id'];
$sql = "UPDATE transaksi SET waktu_keluar = CURRENT_TIMESTAMP WHERE id_transaksi ='$id'";
$result = mysqli_query($conn, $sql);
if ($result) {
    echo "<script>alert('Berhasil diakhiri')</script>";
} else {
    echo "<script>alert('Gagal mengakhiri')</script>";
}
