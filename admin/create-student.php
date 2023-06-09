<?php
session_start();
//authorization
if (!$_SESSION['username']) {
    session_destroy();
    header('Location: ../index.php');
} else if ($_SESSION['username'] && $_SESSION['role'] != 'admin') {
    session_destroy();
    header('Location: ./dashboard.php');
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>

    <title>Admin Dashborad</title>
</head>
<style>
    @import url(https://fonts.googleapis.com/css?family=Raleway:300,400,600);


    body {
        margin: 0;
        font-size: .9rem;
        font-weight: 400;
        line-height: 1.6;
        background-image: url("../img.jpeg");
        background-size: cover;
        background-repeat: no-repeat;
    }

    .navbar-laravel {
        box-shadow: 0 2px 4px rgba(0, 0, 0, .04);
    }

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
    <nav class="mb-2 bg-dark text-center navbar navbar-expand-lg navbar-light navbar-laravel">
        <div class="container">
            <a class="navbar-brand  text-light " href="dashboard.php">AMS</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link  text-light " href="create-student.php">Create Student</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link  text-light " href="create-course.php">Create Course</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active  text-light " href="create-teacher.php">Create Teacher</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active  text-light " href="create-department.php">Create Department</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active  text-light " href="create-session.php">Create Session</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item active">
                        <a class="nav-link active  text-light " href="teacher-assign.php">Teacher Assign</a>
                    </li>
                </ul>
            </div>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link btn btn-danger  text-light " href="../logout.php">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
        <div class="row">
            <div class="col-6">
                <div class="card border-secondary mt-5 mb-3">
                    <div class="card-header">Create Student</div>
                    <div class="card-body">
                        <form method="post" action="create-student.php">
                            <div class="form-group">
                                <label class="form-label" for="name">Name</label>
                                <input type="text" name="name" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="email">Email</label>
                                <input type="text" name="email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label class="form-label">Department</label>
                                <select class="form-control" name="dept" id="">
                                    <option value="">-Select Department-</option>
                                    <?php 
                                    include '../connection.php';
                                    $id = $_REQUEST['id'];
                                    $qry = "SELECT * FROM dept";
                                    $r = mysqli_query($conn, $qry);
                                    while($dept = mysqli_fetch_array($r)){ ?>
                                        <option value="<?php echo $dept['id'] ?>" > <?php echo $dept['name'] ?> </option>
                                        <?php } ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="password">Password</label>
                                <input type="text" name="password" class="form-control">
                            </div>
                            <br>
                            <div class="form-group">
                                <button type="submit" name="submit" class="btn btn-primary">Create</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="card border-secondary mt-5 mb-3">
                    <div class="card-header">Students List</div>
                    <table id="example" class="table table-striped" style="width:95%">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Department</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            include '../connection.php';
                            $qry = "SELECT users.id, users.name, users.email, users.dept_id, users.password, users.role, dept.name as dept FROM users, dept where dept.id = users.dept_id and users.role = 'student'";
                            $r = mysqli_query($conn, $qry);
                            $i = 1;
                            while ($row = mysqli_fetch_array($r)) {
                            ?>
                                <tr>
                                    <td><?php echo $i++; ?></td>
                                    <td><?php echo $row['name'] ?></td>
                                    <td><?php echo $row['email'] ?></td>
                                    <td><?php echo $row['dept'] ?></td>
                                    <td>
                                        <a class="btn btn-primary" href="edit-student.php?id=<?php echo $row['id'] ?>">Edit</a>
                                        <a class="btn btn-danger" href="delete-student.php?id=<?php echo $row['id'] ?>">Delete</a>
                                    </td>
                                </tr>
                            <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php
include '../connection.php';
if (isset($_POST['submit'])) {
    //recvd data from input/control
    $name = $_POST['name'];
    $email = $_POST['email'];
    $dept = $_POST['dept'];
    $pass = $_POST['password'];
    $role = "student";
    //db query
    $query = "INSERT INTO `users`(`name`, `email`, `dept_id`, `password`, `role`) VALUES ('$name', '$email', $dept, '$pass', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "<script type='text/javascript'>window.location.href='create-student.php';</script>";
    }
}
?>