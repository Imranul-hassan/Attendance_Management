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
        <div class="col-9">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card border-secondary mt-5 mb-3" style="max-width: 32rem;">
                        <div class="card-header"><b>Assign Teacher To Course</b></div>
                        <div class="card-body">
                            <form method="post" action="">
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Teacher</label>
                                    <div class="col-lg-10">
                                        <select name="teacher" id="" class="form-control">
                                            <option value="">- Choose Teacher -</option>
                                            <?php
                                            include '../connection.php';
                                            $query2 = "SELECT * FROM `users` WHERE role ='teacher' ";
                                            $sql2 = mysqli_query($conn, $query2);
                                            while ($row2 = mysqli_fetch_array($sql2)) { ?>
                                                <option value="<?php echo $row2['id']; ?>"> <?php echo $row2['name']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Course</label>
                                    <div class="col-lg-10">
                                        <select name="course" id="" class="form-control">
                                            <option value="">- Choose Course -</option>
                                            <?php
                                            include '../connection.php';
                                            $query2 = "SELECT * FROM `courses`";
                                            $sql2 = mysqli_query($conn, $query2);
                                            while ($row2 = mysqli_fetch_array($sql2)) { ?>
                                                <option value="<?php echo $row2['id']; ?>"> <?php echo $row2['name']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Session</label>
                                    <div class="col-lg-10">
                                        <select name="session" id="" class="form-control">
                                            <option value="">- Choose Session -</option>
                                            <?php
                                            include '../connection.php';
                                            $query2 = "SELECT * FROM sessions";
                                            $sql2 = mysqli_query($conn, $query2);
                                            while ($row2 = mysqli_fetch_array($sql2)) { ?>
                                                <option value="<?php echo $row2['id']; ?>"> <?php echo $row2['name']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-lg-2">Department</label>
                                    <div class="col-lg-10">
                                        <select name="dept" id="" class="form-control">
                                            <option value="">- Choose Department -</option>
                                            <?php
                                            include '../connection.php';
                                            $query2 = "SELECT * FROM dept ";
                                            $sql2 = mysqli_query($conn, $query2);
                                            while ($row2 = mysqli_fetch_array($sql2)) { ?>
                                                <option value="<?php echo $row2['id']; ?>"> <?php echo $row2['name']; ?> </option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-9">
                                        <button type="submit" name="submit" class="btn btn-success">Assign</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</body>

</html>

<?php
if (isset($_POST['submit'])) {
    //recvd data from input/control
    $teacher = $_POST['teacher'];
    $course = $_POST['course'];
    $session = $_POST['session'];
    $dept = $_POST['dept'];


    //db query
    //status 0 for new enroll and 1 for completed
    $query = "INSERT INTO `teacher_assign`(`teacher_id`, `course_id`,`session_id`, `dept_id`, `status`) VALUES ('$teacher', '$course',$session, $dept,  0)";
    if (mysqli_query($conn, $query)) {
        echo "successfully assigned!!";
    }
}
?>