<?php 
    session_start();
    //authorization
    if(!$_SESSION['username']){
      session_destroy();
      header('Location: ../index.php');
    }
    else if($_SESSION['username'] && $_SESSION['role'] != 'admin'){
      session_destroy();
      header('Location: ../unauthorised_user.php');
    }
    include '../connection.php';
    $id = $_REQUEST['id'];
    $qry="DELETE from users where id=$id";
    if(mysqli_query($conn,$qry)){
        header('Location: create-student.php');
    }
