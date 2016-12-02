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
     $user_id = $_SESSION['user_id'];
     $query = "SELECT * FROM profile WHERE user_id = '$user_id'";
     $result = mysqli_query($con, $query);
     if(!$result) {
         echo "Query Failed !";
     }

     $row = mysqli_fetch_array($result);

     if($row['p_ok'] != 1) {
        header("Location: add-profile.php");
        exit;
     }
 ?>

 <?php
     $query = "SELECT * FROM profile WHERE user_id = '$user_id'";
     $result = mysqli_query($con, $query);
     if(!$result) {
         echo "Query Failed !";
     }

     while($row = mysqli_fetch_array($result)) {
 ?>

<div class="profile-showcase clearfix">
    <div class="profile-basic">
        <?php echo "<img id=\"outputs\" src=get-profile-image.php?id=".$row['user_id'].">"; ?>
        <h1><?php echo $row['profile_name'] ?></h1>
        <p><span class="big">"</span><?php echo $row['profile_title'] ?><span class="big">"</span></p>
    </div>

    <div class="profile-details">
        <h2>About Me: </h2>
        <p><span class="big">"</span><?php echo $row['profile_about'] ?><span class="big">"</span></p>

        <h2>My Hobbies: </h2>
        <p><span class="big">"</span><?php echo $row['profile_hobby'] ?><span class="big">"</span></p>

        <h2>My Educations: </h2>
        <p><span class="big">"</span><?php echo $row['profile_education'] ?><span class="big">"</span></p>

        <h2>My experiences: </h2>
        <p><span class="big">"</span><?php echo $row['profile_experience'] ?><span class="big">"</span></p>
    </div>
</div>

<?php
    }
?>


<div class="pf-info">
    <div class="pf-edit">
        <a href="edit-profile.php?id=<?php echo $user_id ?>">Edit Profile</a>
    </div>

    <?php
        $fquery = "SELECT * FROM friends WHERE profile_id = '$user_id'";
        $fresults = mysqli_query($con, $fquery);
        if(!$fresults) {
            echo "failed to load friends!";
        }
        $frow = mysqli_num_rows($fresults);

        $pquery = "SELECT * FROM posts WHERE user_id = '$user_id'";
        $presults = mysqli_query($con, $pquery);
        if(!$presults) {
            echo "failed to load posts!";
        }
        $prow = mysqli_num_rows($presults);
    ?>
    <div class="pf-friends">
        <a href="#">
            <i class="fa fa-group" aria-hidden="true"></i>
            Total Friends:
            <br>
             <p><?php echo $frow;?></p>
        </a>
    </div>
    <div class="pf-posts">
        <a href="#">
            <i class="fa fa-comments-o" aria-hidden="true"></i>
            Total Posts:
            <br>
            <p><?php echo $prow;?></p>
        </a>
    </div>
</div>

<?php require_once('footer.php')?>
