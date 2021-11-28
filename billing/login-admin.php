<?php

include 'config.php';

error_reporting(0);

session_start();

if (isset($_SESSION['id_admin'])) {
    header("Location: admin-dashboard.php");
}

if (isset($_POST['submit'])) {
    $username = $_POST['username'];
    $password = md5($_POST['password']);

    $sql = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($conn, $sql);
    if ($result->num_rows > 0) {
        $row = mysqli_fetch_assoc($result);
        $_SESSION['id_admin'] = $row['id_admin'];
        header("Location: admin-dashboard.php");
    } else {
        echo "<script>alert('username atau password Anda salah. Silahkan coba lagi!')</script>";
    }
}

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
    <link rel="stylesheet" type="text/css" href="style.css">

    <title>Login Admin</title>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="login-admin.php">Admin Dextu</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">



        </div>
    </nav>
    <div class="alert" role="alert">
        <?php echo $_SESSION['error'] ?>
    </div>

    <div class="card">
        <div class="container">
            <div class="row">
                <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                    <div class="card card-signin my-5">
                        <div class="card-body">
                            <h3 class="card-title text-center">Admin Login</h3>
                            <form action="" method="POST" class="login-email">

                                <label>Username</label>
                                <div class="form-label-group">
                                    <input type="text" class="form-control" placeholder="Username" name="username" value="<?php echo $username; ?>" required>
                                </div>
                                <label>Password</label>
                                <div class="form-label-group">
                                    <input type="password" class="form-control" placeholder="Password" name="password" value="<?php echo $_POST['password']; ?>" required>
                                </div><br>
                                <div class="input-group">
                                    <button name="submit" class="btn btn-success btn-block">Login</button>
                                </div>

                                <br>
                            </form>
                        </div>
                    </div>
                </div>
            </div><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
    </div>
</body>

</html>