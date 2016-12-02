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
    if(isset($_POST['submit']))
    {
        post($con);
    }

    function post($con) {
        if(!empty($_POST['post'])) {

            date_default_timezone_set('Asia/Dhaka');

            $post = $_POST['post'];
            $post_by = $_SESSION['user'];
            $post_time = date('Y-m-d H:i:s');
            $user_id = $_SESSION['user_id'];

            $query1 = "INSERT INTO posts
            (`post_id`, `user_id`, `post_by`, `post_time`, `post_body`)
            VALUES
            (NULL, '$user_id', '$post_by', '$post_time', '$post');";

            $result1 = mysqli_query($con, $query1);

            if(!$result1) {
                echo "<p id=\"failure-msg\">Post Failed!</p>";
            }else {
                header("Location: home.php");
                exit;
            }
        }
    }

?>

<div class="home-body">

    <div class="home-friends">
        <div class="popular-fr">
            <h2>Recent Members: </h2>
            <?php
                $mem = 0;
                $user_id = $_SESSION['user_id'];
                $query = "SELECT * FROM profile WHERE NOT user_id = $user_id ORDER BY profile_id DESC";
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
                    <a href="seeprofile.php?id=<?php echo $row['user_id']?>"><i class="fa fa-bullhorn" aria-hidden="true"></i>
 View Profile</a>
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

    <div class="post-area">
        <form class="post-form" action="home.php" method="post">
            <textarea id="post-box" required="required" name="post" rows="10" cols="60" placeholder="Post Something On Your Wall......"></textarea>
            <br>
            <input type="submit" name="submit" id="post-btn" value="POST">
        </form>
    </div>

    <div class="news-feed">
        <h2>Recent Posts: </h2>
        <?php
            $count = 0;
            $query = "SELECT * FROM posts ORDER BY post_id DESC";
            $result = mysqli_query($con, $query);
            if(!$result) {
                echo "Query Failed !";
            }
            while($row = mysqli_fetch_array($result)) {
                $count++;
                $user = $row['user_id'];

                $query2 = "SELECT * FROM profile WHERE user_id = '$user'";
                $result2 = mysqli_query($con, $query2);
                if(!$result2) {
                    echo "Query Failed !";
                }
                $row2 = mysqli_num_rows($result2);

                $output = "<div class=\"single-posts clearfix\">";
                $output .= "<div class=\"post-info\">";
                if($row2 == 0) {
                    $output .= "<i class=\"fa fa-question-circle\" aria-hidden=\"true\"></i>";
                }else {
                    $output .= "<img class=\"pimg\" src=get-profile-image.php?id=".$row['user_id'].">";
                }
                $output .= "<h2>".$row['post_by']."</h2>";
                $output .= "<p>".$row['post_time']."</p>";
                $output .= "</div>";
                $output .= "<div class=\"post-details\">";
                $output .= "<p>".$row['post_body']."</p>";
                $output .= "<div class=\"like-box\">";

                $output .= "<h3><i class=\"fa fa-gratipay\" aria-hidden=\"true\"></i>
     ".$row['post_likes']."</h3>";

                $output .= "<span><a href=\"likes.php?id=".$row['post_id']."\"><i class=\"fa fa-thumbs-up\" aria-hidden=\"true\"></i>
LIKE</a></span>";

                $output .= "</div>";
                $output .= "</div>";
                $output .= "</div>";
                $output .= "<a href=\"posts-single.php?id=".$row['post_id']."\" class=\"post-single\">View Full Post<i class=\"fa fa-comments-o\" aria-hidden=\"true\"></i>
</a>";

                echo $output;
            }

            if($count == 0) {
                echo "No Posts To Show !";
            }
        ?>

    </div>


</div>




<?php require_once('footer.php')?>
