<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];

    $query = "DELETE FROM users WHERE user_id = $id";
    $result = mysqli_query($con, $query);

    $query1 = "DELETE FROM profile WHERE user_id = $id";
    $result1 = mysqli_query($con, $query1);

    if(!$result && !$result1) {
        echo "Query Failed !";
    }else {
        header('Location: admin-control.php');
        exit;
    }

?>
