<?php

session_start();

if (!isset($_SESSION['id_admin'])) {
    header("Location: login-admin.php");
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
    <title>Daftar User</title>
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
    <div class="container p-3 my-3 text-black ">

        <h3>Daftar User</h3>

        <div class="input-group mb-2">
            <a class="btn btn-primary float-sm-right" href="add-user.php">+ Tambah User Baru</a>

        </div>

        <form action="" method="get">
            <div class="input-group mb-2">
                <input type="search" name="search" class="form-control rounded col-xs-2" placeholder="Cari Username" aria-label="Search" aria-describedby="search-addon" />
                <input type="submit" class="btn btn-success" value="Cari">
            </div>
        </form>

        <table class="table table-bordered table-responsive-md table-striped text-center">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Username</th>
                    <th scope="col">Level Member</th>
                    <th scope="col">Total Transaksi</th>
                    <th scope="col">Aksi </th>
                </tr>
            </thead>
            <tbody>
                <?php
                include 'config.php';
                if (isset($_GET['search'])) {
                    $search = $_GET['search'];
                    $sql = "SELECT users.id_user, users.username, member.nama, count(transaksi.id_user) as jumlah from users 
                    INNER JOIN member on users.id_member=member.id_member 
                    LEFT JOIN transaksi ON users.id_user = transaksi.id_user 
                    WHERE username like '%" . $search . "%'
                    GROUP BY users.id_user ";
                } else {
                    $sql = "SELECT  users.id_user, users.username, member.nama, count(transaksi.id_user) as jumlah 
                    from users 
                    INNER JOIN member on users.id_member=member.id_member 
                    LEFT JOIN transaksi ON users.id_user = transaksi.id_user 
                    GROUP BY users.id_user";
                }

                $query = mysqli_query($conn, $sql);

                while ($data = mysqli_fetch_array($query)) {

                    echo "<tr>";

                    echo "<td>" . $data['id_user'] . "</td>";
                    echo "<td>" . $data['username'] . "</td>";
                    echo "<td>" . $data['nama'] . "</td>";
                    echo "<td>" . $data['jumlah'] . "</td>";
                ?>
                    <td>
                        <a href="edit.php?id=<?php echo $data['id_user']; ?>" class="btn btn-warning btn-rounded btn-sm my-0">Edit</a>
                        <a href="delete.php?id=<?php echo $data['id_user']; ?>" class="btn btn-danger btn-rounded btn-sm my-0">Hapus</a>
                    </td>
                <?php
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