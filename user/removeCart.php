<?php
    include '../validation/connectSQL.php';

    //Select UserID from user
    $loginUsername = $_SESSION['loginUser'];
    $userID = $_SESSION['userID'];

    $conn = mysqli_connect($servername, $dbUsername, $dbPassword, 'gardenia_shoppingcart');
    if ($conn) {
        //clear user shoppingcart
        $sql = "TRUNCATE TABLE user_$userID";
        $result = mysqli_query($conn, $sql);
    }
?>