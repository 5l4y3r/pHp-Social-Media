<?php session_start(); ?>
<?php require_once('database.php')?>
<?php
    global $id;
    $id = $_REQUEST['id'];
    $sid = $_SESSION['user_id'];


    $query1 = "SELECT * FROM posts WHERE post_id = '$id'";
    $result1 = mysqli_query($con, $query1);

    if(!$result1) {
        echo "Query Failed !";
    }

    $row = mysqli_fetch_array($result1);

    $like = $row['post_likes'];
    $like = $like + 1;

    $query = "UPDATE posts SET post_likes ='$like' WHERE post_id = '$id'";
    $result = mysqli_query($con, $query);

    if(!$result) {
        echo "Query Failed !";
    }else {
        header('Location: home.php');
        exit;
    }

?>
