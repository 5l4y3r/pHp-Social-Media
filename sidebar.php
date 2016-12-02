<?php
    $id = $_SESSION['user_id'];

    $query = "SELECT * FROM notifications WHERE n_recever = $id";
    $result = mysqli_query($con, $query);
    if(!$result){
        echo "query failed!";
    }
    $row = mysqli_num_rows($result);

    $query2 = "SELECT * FROM friends WHERE profile_id = $id";
    $result2 = mysqli_query($con, $query2);
    if(!$result2){
        echo "query failed!";
    }
    $row2 = mysqli_num_rows($result2);

    $query3 = "SELECT * FROM posts WHERE user_id = $id";
    $result3 = mysqli_query($con, $query3);
    if(!$result3){
        echo "query failed!";
    }
    $row3 = mysqli_num_rows($result3);


?>
<div class="sidebar">
    <ul class="sidebar-list">
        <li>
            <a href="home.php"><i class="fa fa-home" aria-hidden="true"></i>Home</a>
        </li>
        <li>
            <a href="notifications.php"><i class="fa fa-bell" aria-hidden="true"></i>Notifications &nbsp; <?php if($row != 0) echo "(".$row.")"; ?></a>
        </li>
        <li>
            <a href="profile.php"><i class="fa fa-paw" aria-hidden="true"></i>Profile</a>
        </li>
        <li>
            <a href="friends.php"><i class="fa fa-group" aria-hidden="true"></i>My Friends &nbsp; <?php if($row2 != 0) echo "(".$row2.")"; ?></a>
        </li>
        <li>
            <a href="posts.php"><i class="fa fa-comments-o" aria-hidden="true"></i>My Posts &nbsp; <?php if($row3 != 0) echo "(".$row3.")"; ?></a>
        </li>
        <li>
            <a href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i>Exit</a>
        </li>
    </ul>
</div>
