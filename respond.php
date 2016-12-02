<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];
    $sid = $_SESSION['user_id'];

    $query = "INSERT INTO friends (`fr_id`, `profile_id`, `friends_id`)
    VALUES (NULL, '$sid', '$id');";
    $result = mysqli_query($con, $query);

    $query1 = "INSERT INTO friends (`fr_id`, `profile_id`, `friends_id`)
    VALUES (NULL, '$id', '$sid');";
    $result1 = mysqli_query($con, $query1);

    $query2 = "DELETE FROM notifications WHERE n_recever = $sid && n_sender = $id";
    $result2 = mysqli_query($con, $query2);

    if(!$result && !$result1 && !$result2) {
        echo "Query Failed !";
    }else {
        header('Location: seeprofile.php?id='. $id);
        exit;
    }

?>
