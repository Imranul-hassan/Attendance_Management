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
        background-position: 100% 100%;
        background-repeat: repeat;
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
        <div class="col-12">
            <div class="row">
                <div class="col-6">
                    <div class="card border-secondary mt-5 mb-3">
                        <div class="card-header">Create Teacher</div>
                        <div class="card-body">
                            <form method="post" action="create-teacher.php">
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
                        </div>
                        </form>
                    </div>
                </div>
                <div class="col-6">
                    <div class=" card border-primary text-dark mt-5 mb-3">
                        <div class="card-header">Teachers List</div>
                        <table id="example" class="table table-striped" style="width:95%">
                            <thead>
                                <tr>
                                    <th>S/N</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include '../connection.php';
                                $qry = "SELECT * FROM `users` WHERE role = 'teacher'";
                                $r = mysqli_query($conn, $qry);
                                $i = 1;
                                while ($row = mysqli_fetch_array($r)) {
                                ?>
                                    <tr>
                                        <td><?php echo $i++; ?></td>
                                        <td><?php echo $row['name'] ?></td>
                                        <td><?php echo $row['email'] ?></td>
                                        <td>
                                            <a class="btn btn-primary" href="edit-teacher.php?id=<?php echo $row['id'] ?>">Edit</a>
                                            <a class="btn btn-danger" href="delete-teacher.php?id=<?php echo $row['id'] ?>">Delete</a>
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
    </div>
</body>
</html>
<?php
include '../connection.php';
if (isset($_POST['submit'])) {
    //recvd data from input/control
    $name = $_POST['name'];
    $email = $_POST['email'];
    $pass = $_POST['password'];
    $dept = $_POST['dept'];
    $role = "teacher";
    //db query
    $query = "INSERT INTO `users`(`name`, `email`, `dept_id`, `password`, `role`) VALUES ('$name', '$email', $dept, '$pass', '$role')";
    if (mysqli_query($conn, $query)) {
        echo "<script type='text/javascript'>window.location.href='create-teacher.php';</script>";
    }
}
?>