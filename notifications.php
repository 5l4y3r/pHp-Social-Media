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

<div class="nt-area">
    <h1>My Notifications: </h1>
    <?php
        $count = 0;
        $id = $_SESSION['user_id'];
        $query = "SELECT * FROM notifications WHERE n_recever = '$id'";
        $result = mysqli_query($con, $query);
        if(!$result) {
            echo "Query Failed !";
        }

        while($row = mysqli_fetch_array($result)) {

        $user_id = $row['n_sender'];

        $query2 = "SELECT * FROM profile WHERE user_id = '$user_id'";
        $result2 = mysqli_query($con, $query2);
        if(!$result2) {
            echo "Query Failed !";
        }

        while($row2 = mysqli_fetch_array($result2)) {
            $count++;
    ?>
    <ul class="nt-list">
        <li>
            <h2>
            <i class="fa fa-snapchat-square" aria-hidden="true"></i>
 You Have Receved A Friend Request From &rarr; &nbsp;&nbsp;
            <a href="seeprofile.php?id=<?php echo $user_id;?>"><?php echo $row2['profile_name'];;?></a></h2>
            <p><a href="respond.php?id=<?php echo $user_id;?>">Respond 2 Request <i class="fa fa-check-circle" aria-hidden="true"></i></a></p>
        </li>
    </ul>

    <?php
            }
        }
        if ($count == 0) {
            echo "No New Notifications !";
        }
    ?>

</div>



<?php require_once('footer.php')?>
