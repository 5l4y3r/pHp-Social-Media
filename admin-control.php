<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('database.php')?>
<?php
    if(!$_SESSION['user'])
        {
            header('Location: login.php');
        }
?>
<?php require_once('home-header.php')?>
<?php require_once('sidebar.php')?>

<?php

?>


<div class="search-friends">
    <div class="popular-fr">
        <h2>All Members :</h2>
        <?php
            $user = $_SESSION['user_id'];
            $mem = 0;
            $query = "SELECT * FROM profile WHERE NOT user_id = '$user'";
            $result = mysqli_query($con, $query);
            if(!$result) {
                echo "Query Failed !";
            }

            while($row = mysqli_fetch_array($result)) {
                $mem++;
        ?>
        <ul class="pfr-list">
            <li class="clearfix">
                <?php echo "<img class=\"fr-pic\" src=get-profile-image.php?id=".$row['user_id'].">"; ?>
                <h1><?php echo $row['profile_name'];?></h1>
                <p><span class="big">"</span><?php echo $row['profile_name'];?><span class="big">"</span></p>
                <a href="delete-users.php?id=<?php echo $row['user_id']?>">Remove User</a>
                <?php
                    $cuser = $row['user_id'];
                    $query1 = "SELECT status FROM user WHERE user_id = '$cuser'";
                    $result1 = mysqli_query($con, $query1);
                    if(!$result1) {
                        echo "failed to load block users !";
                    }
                    $row1 = mysqli_fetch_array($result1);
                    $status = $row1['status'];
                    if($status == 0) {
                ?>
                <a href="block-users.php?id=<?php echo $row['user_id']?>">Block User</a>
                <?php
            }else {
                ?>
                <a href="unblock-users.php?id=<?php echo $row['user_id']?>">Unblock User</a>
                <?php
            }
                ?>
                <a href="seeprofile.php?id=<?php echo $row['user_id']?>">View Profile</a>
            </li>
        </ul>
        <?php
                }
                if($mem == 0) {
                    echo "No Firends to Display !";
                }
        ?>
    </div>
</div>



<?php require_once('footer.php')?>
