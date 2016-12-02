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
        global $id;
        $id = $_REQUEST['id'];

        if(isset($_POST['comment'])) {
            comment_now($con,$id);
        }

        function comment_now($con,$id) {
            if(!empty($_POST['cmtbox'])) {
                global $id;
                $cmt_by_id = $_SESSION['user_id'];
                $cmt_by = $_SESSION['user'];
                $cmt_time = date('Y-m-d H:i:s');
                $cmt = $_POST['cmtbox'];
                $post_id = $id;

                $cquery = "INSERT INTO comments
                (`cmt_id`, `post_id`, `cmt_by_id`, `cmt_by`, `cmt`, `cmt_time`)
                VALUES (NULL, '$post_id', '$cmt_by_id', '$cmt_by', '$cmt', '$cmt_time');";

                $cresult = mysqli_query($con, $cquery);
                if(!$cquery) {
                    echo "commenting Failed !";
                }else {
                    header('Location: posts-single.php?id=' . $id);
                    exit;
                }
            }else {
                echo "Write Something to Post ~!";
            }
        }

        $query = "SELECT * FROM posts WHERE post_id = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) {
            echo "Query Failed !";
        }

        while($row = mysqli_fetch_array($result)) {
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
    ?>
</div>

<div class="comment-box">
    <h1>Comments: </h1>
    <form class="comment-form" action="posts-single.php?id=<?php echo $id; ?>" method="post">
        <input name="cmtbox" required="required" placeholder="Comment Something..." type="text" id="cmt-field"/>
        <input type="submit" name="comment" id="cmt-btn" value="comment">
    </form>


    <div class="cmt-section">
        <div class="popular-fr">
            <?php
                $mem = 0;
                $query = "SELECT * FROM comments WHERE post_id = '$id' ORDER BY cmt_id DESC";
                $result = mysqli_query($con, $query);
                if(!$result) {
                    echo "Query Failed !";
                }

                while($row = mysqli_fetch_array($result)) {
                    $mem++;
            ?>
            <ul class="pfr-list">
                <li class="clearfix">
                    <?php echo "<img class=\"fr-pic\" src=get-profile-image.php?id=".$row['cmt_by_id'].">"; ?>
                    <h1><?php echo $row['cmt_by'];?></h1>
                    <p><span class="big">"</span><?php echo $row['cmt'];?><span class="big">"</span></p>
                </li>
            </ul>
            <?php
                    }
                    if($mem == 0) {
                        echo "No Comments to Display !";
                    }
            ?>
        </div>
    </div>
</div>


<?php require_once('footer.php')?>
