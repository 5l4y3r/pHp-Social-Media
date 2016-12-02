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

<div class="my-frnds">
    <h1>My Friends: </h1>
    <?php
        $count = 0;
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM friends WHERE profile_id = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) {
            echo "Query Failed !";
        }

        while($row = mysqli_fetch_array($result)) {

            $user_id = $row['friends_id'];

            $query2 = "SELECT * FROM profile WHERE user_id = '$user_id'";
            $result2 = mysqli_query($con, $query2);
            if(!$result2) {
                echo "Query Failed !";
            }

            while($row2 = mysqli_fetch_array($result2)) {
                $count++;
    ?>
    <ul class="frnd-list">
        <li>
            <?php echo "<img src=get-profile-image.php?id=".$row2['user_id'].">"; ?>
            <h2><?php echo $row2['profile_name'];?><h2>
            <p><span class="big">"</span><?php echo $row2['profile_title'];?><span class="big">"</span></p>
            <a href="seeprofile.php?id=<?php echo $row2['user_id']?>"><i class="fa fa-binoculars" aria-hidden="true"></i>
View Profile</a>
            <a href="delete-friend.php?id=<?php echo $row2['user_id']?>" onclick="return confirm('Are you sure you want to delete this? ');"><i class="fa fa-trash" aria-hidden="true"></i>
Delete Friend</a>
        </li>
    </ul>
    <?php
            }
        }
        if ($count == 0) {
            echo "You Have No Friends !";
        }
    ?>
</div>

<?php require_once('footer.php')?>
