<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];
    $sid = $_SESSION['user_id'];

    $query = "INSERT INTO notifications
    (`n_id`, `n_type`, `n_recever`, `n_sender`)
    VALUES
    (NULL, 'friend request', '$id', '$sid');";
    $result = mysqli_query($con, $query);
    if(!$result) {
        echo "Query Failed !";
    }else {
        header('Location: seeprofile.php?id='. $id);
        exit;
    }

?>
