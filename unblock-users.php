<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];

    $query = "UPDATE user SET status = '0' WHERE user_id = '$id'";
    $result = mysqli_query($con, $query);


    if(!$result) {
        echo "Query Failed !";
    }else {
        header('Location: admin-control.php');
        exit;
    }

?>
