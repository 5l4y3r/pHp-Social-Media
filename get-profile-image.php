<?php

    require_once("database.php");

    $id = $_REQUEST['id'];

    $image = mysqli_query($con, "SELECT * FROM profile WHERE user_id = $id") or die();

    $image = mysqli_fetch_assoc($image);

    $image = $image['profile_pic'];

    header("Content-type: image/jpeg");

    echo $image;

?>
