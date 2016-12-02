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
    global $id;
    $id = $_REQUEST['id'];

    if(isset($_POST['edit']))
    {
        update_post($con, $id);
    }

    function update_post($con, $id) {
        if(!empty($_POST['post'])) {

            $post = $_POST['post'];

            if(!$result2 = mysqli_query($con, "UPDATE posts SET post_body ='$post' WHERE post_id = $id")) {
                echo "<p id=\"failure-msg\">Problem Uploading !</p>";
            }else {
                echo "<p id=\"success-msg\">Profile Updated!</p>";
                header('Location: posts.php');
                exit;
            }

        }else {
            echo "empty !";
        }
    }


    $query = "SELECT * FROM posts WHERE post_id = '$id'";
    $result = mysqli_query($con, $query);
    if(!$result) {
        echo "Query Failed !";
    }

    $row = mysqli_fetch_array($result);
?>

<div class="edit-post">
    <h1>Edit Your Post: </h1>
    <form class="post-form" action="edit-post.php?id=<?php echo $id; ?>" method="post">
        <textarea id="post-box" name="post" rows="10" cols="60" placeholder="What's On Your Mind? ............"><?php echo $row['post_body'];?></textarea>
        <br>
        <input type="submit" name="edit" id="pedit-btn" value="UPDATE POST">
    </form>
</div>
