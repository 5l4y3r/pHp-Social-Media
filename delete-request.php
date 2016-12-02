<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];
    $sid = $_SESSION['user_id'];

    $query = "DELETE FROM notifications WHERE n_recever = $id && n_sender = $sid";
    $result = mysqli_query($con, $query);

    if(!$result) {
        echo "Query Failed !";
    }else {
        header('Location: seeprofile.php?id='. $id);
        exit;
    }

?>
