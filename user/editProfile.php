<?php
session_start();
$userID = $_SESSION['userID'];

//Get the value of the button to know which form is updating
$type = $_POST['button'];

include '../validation/connectSQL.php';

//I tried to make it so that profile page will update without reloading or going to other page, but every method i tried are not working,
//in the end have to make it like this

if($type == 'name'){
    $fname = $_POST['firstname'];
    $lname = $_POST['lastname'];

    $sql = "UPDATE user SET Name='$fname $lname' WHERE UserID=$userID";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
    
}else if($type == 'email'){
    $email = $_POST['email'];

    $sql = "UPDATE user SET Email='$email' WHERE UserID=$userID";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}else if($type == 'mobile'){
    $mobile = $_POST['mobile'];

    $sql = "UPDATE user SET Mobile='$mobile' WHERE UserID=$userID";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}else if($type == 'state'){
    $state = $_POST['state'];

    $sql = "UPDATE user SET State='$state' WHERE UserID=$userID";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}else if($type == 'gender'){
    $gender = $_POST['gender'];

    $sql = "UPDATE user SET Gender='$gender' WHERE UserID=$userID";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}else if($type == 'password'){
    $password = $_POST['password'];
    $password = password_hash($password, PASSWORD_DEFAULT);

    $sql = "UPDATE user SET Password='$password' WHERE UserID=$userID";
    mysqli_query($conn, $sql);
    header('Location: userProfile.php');
}
?>