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
 ?>

 <?php
     $query = "SELECT * FROM profile WHERE user_id = '$id'";
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
        <?php
            $pid = $_SESSION['user_id'];

            $query = "SELECT * FROM friends WHERE profile_id=$pid && friends_id=$id";
            $query1 = "SELECT * FROM notifications WHERE n_sender=$pid && n_recever=$id";
            $query2 = "SELECT * FROM notifications WHERE n_recever=$pid && n_sender=$id";

            $result = mysqli_query($con, $query);
            $result1 = mysqli_query($con, $query1);
            $result2 = mysqli_query($con, $query2);
            if(!$result) {
                echo "Query Failed !";
            }
            if(!$result1) {
                echo "Query1 Failed !";
            }
            if(!$result2) {
                echo "Query2 Failed !";
            }

            $row = mysqli_fetch_array($result);
            $row1 = mysqli_fetch_array($result1);
            $row2 = mysqli_fetch_array($result2);


            if($id == $row['friends_id']) {
                echo "<a href='#'>My Friend</a>";
            }
            elseif ($id == $row1['n_recever']) {
                echo "<a href='#'>Request Send !</a>";
            }
            elseif ($id == $row2['n_sender']) {
                echo "<a href='respond.php?id=$id'>Respond!</a>";
            }
            else {
                echo "<a href='add-friend.php?id=$id'>Add As Friend</a>";
            }

        ?>
    </div>
    <div class="pf-friends">

        <?php
            $user_id = $id;

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

        <a href="#">
            <i class="fa fa-group" aria-hidden="true"></i>
            Friends:
            <br>
             <p><?php echo $frow;?></p>
        </a>
    </div>
    <div class="pf-posts">
        <a href="#">
            <i class="fa fa-comments-o" aria-hidden="true"></i>
            Posts:
            <br>
            <p><?php echo $prow;?></p>
        </a>
    </div>
    <?php
        if ($id == $row1['n_recever']) {
            echo "<a id='cancel' href='delete-request.php?id=$id'>Cancel Request!</a>";
        }
    ?>

</div>

<?php require_once('footer.php')?>
