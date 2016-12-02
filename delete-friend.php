<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];
    $sid = $_SESSION['user_id'];

    $query = "DELETE FROM friends WHERE friends_id = $id && profile_id = $sid";
    $result = mysqli_query($con, $query);

    $query1 = "DELETE FROM friends WHERE profile_id = $id && friends_id = $sid";
    $result1 = mysqli_query($con, $query1);

    if(!$result && !$result1) {
        echo "Query Failed !";
    }else {
        header('Location: friends.php');
        exit;
    }

?>
