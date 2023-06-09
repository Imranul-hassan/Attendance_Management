<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Login</title>
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);

    body {
        background-image: url("./img.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
    }
    /* body {
        margin: 0;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        color: #212529;
        text-align: left;
        background-color: #f5f8fa;
    } */
    .navbar-brand,
    .nav-link,
    .my-form,
    .login-form {
        font-family: Raleway, sans-serif;
    }

    .my-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .my-form .row {
        margin-left: 0;
        margin-right: 0;
    }

    .login-form {
        padding-top: 1.5rem;
        padding-bottom: 1.5rem;
    }

    .login-form .row {
        margin-left: 0;
        margin-right: 0;
    }
</style>

<body>
    <div class="p-3 mb-4 bg-secondary text-center text-white">
        <h1>Attendance Management System</h1>
    </div>
    </div>

    <main class="login-form">
        <div class="cotainer">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-dark text-light"><b class="justify-content-center">Login</b></div>
                        <div class="card-body bg-secondary text-light">
                            <form method="post" action="index.php">
                                <div class="form-group row">
                                    <label for="email_address" class="col-md-4 col-form-label text-md-right">E-Mail Address</label>
                                    <div class="col-md-6">
                                        <input type="email" id="email_address" class="form-control" name="email" required autofocus>
                                    </div>
                                </div>

                                <div class="form-group row">
                                    <label for="password" class="col-md-4 col-form-label text-md-right">Password</label>
                                    <div class="col-md-6">
                                        <input type="password" id="password" class="form-control" name="password" required>
                                    </div>
                                </div>

                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" name="submit" value="submit" class="btn btn-success">login</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </main>
</body>

</html>

<?php
include("connection.php");
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $password = $_POST['password'];
    $query = "SELECT * FROM users WHERE email = '$email' AND password='$password'";
    $sql = mysqli_query($conn, $query);
    $row = mysqli_fetch_array($sql);
    $role = $row['role'];
    //admin login
    if ($role == 'admin') {
        $username = $row['name'];
        $_SESSION['username'] = $username;
        $_SESSION['role'] = $role;
        $_SESSION['id'] = $id;
        header('Location: admin/dashboard.php');
    }
    //teacher login
    else if ($role == "teacher") {
        $username = $row['name'];
        $id = $row['id'];
        $_SESSION['username'] = $username;
        $_SESSION['id'] = $id;
        $_SESSION['role'] = $role;
        header('Location: teacher/dashboard.php');
    } else {
        echo "<strong>Wrong email or password</strong>";
    }
}
?>