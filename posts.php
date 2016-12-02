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

<div class="p-area">
    <h1>My Posts:</h1>

    <?php
        $count = 0;
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM posts WHERE user_id = '$id' ORDER BY post_id DESC";
        $result = mysqli_query($con, $query);
        if(!$result) {
            echo "Query Failed !";
        }

        while($row = mysqli_fetch_array($result)) {
                $count++;
    ?>

    <ul class="p-list">
        <li class="clearfix">
            <h3><?php echo $row['post_body'];?><h3>
            <h4><i class="fa fa-clock-o" aria-hidden="true"></i>
 Posted On: <?php echo $row['post_time'];?></h4>
            <p><i class="fa fa-heartbeat" aria-hidden="true"></i>
 Likes: <?php echo $row['post_likes'];?><p>
            <div class="list-half">
                <a href="edit-post.php?id=<?php echo $row['post_id']; ?>"><i class="fa fa-pencil-square" aria-hidden="true"></i>
 Edit Post</a>
                <a href="delete-post.php?id=<?php echo $row['post_id']; ?>" onclick="return confirm('Are you sure you want to delete this? ');"><i class="fa fa-trash" aria-hidden="true"></i>
 Delete Post</a>
            </div>

        </li>
    </ul>
    <?php
        }
        if ($count == 0) {
            echo "You Have No Posts!";
        }
    ?>
</div>


<?php require_once('footer.php')?>
