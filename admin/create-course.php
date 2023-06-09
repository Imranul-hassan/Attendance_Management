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
        <div class="col-12">
            <div class="row">
                <div class="col-lg-6">
                    <div class="card border-secondary mt-5 mb-3">
                        <div class="card-header"><b>Create Course</b></div>
                        <div class="card-body">
                            <form class="form-horizontal" method="post" action="">
                                <div class="form-group">
                                    <label class="form-label" for="name">Course Name</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="name" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="code">Code</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="code" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label" for="credit">Credit</label>
                                    <div class="col-lg-10">
                                        <input type="text" name="credit" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="form-label">Type</label>
                                    <div class="col-lg-10">
                                        <select class="form-control" name="type" id="">
                                            <option value="">- Choose Course Type -</option>
                                            <option value="Theory">Theory</option>
                                            <option value="Lab">Lab</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-9">
                                        <button type="submit" name="submit" class="btn btn-primary">Create</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-6">
                    <div class="card border-secondary mt-5 mb-3">
                        <div class="card-header"><b>Course List</b></div>
                        <table id="example" class="table table-striped" style="width:95%">
                            <thead>
                                <th>Name</th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Credit</th>
                                <th>Action</th>
                            </thead>
                            <tbody>
                                <?php
                                include '../connection.php';
                                $qry = "SELECT * FROM `courses`";
                                $r = mysqli_query($conn, $qry);
                                while ($row = mysqli_fetch_array($r)) { ?>
                                    <tr>
                                        <td> <?php echo $row['name'] ?> </td>
                                        <td> <?php echo $row['code'] ?> </td>
                                        <td> <?php echo $row['type'] ?> </td>
                                        <td> <?php echo $row['credit'] ?> </td>
                                        <td>
                                            <a class="btn btn-primary" href="edit-course.php?id=<?php echo $row['id'] ?>">Edit</a>
                                            <a class="btn btn-danger" href="delete-course.php?id=<?php echo $row['id'] ?>">Delete</a>
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
    $code = $_POST['code'];
    $credit = $_POST['credit'];
    $type = $_POST['type'];
    //db query
    $query = "INSERT INTO `courses`(`name`, `code`, `credit`, `type`) VALUES ('$name','$code', '$credit', '$type')";
    if (mysqli_query($conn, $query)) {
        echo "<script type='text/javascript'>window.location.href='create-course.php';</script>";
    }
}
?>