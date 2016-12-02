<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];
    $sid = $_SESSION['user_id'];

    $query = "DELETE FROM posts WHERE post_id = $id && user_id = $sid";
    $result = mysqli_query($con, $query);

    if(!$result) {
        echo "Query Failed !";
    }else {
        header('Location: posts.php');
        exit;
    }

?>
