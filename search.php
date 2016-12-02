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
        <h2>Search Results :</h2>
        <?php

            if(isset($_POST['search']))
            {
                search_friends($con);
            }

            function search_friends($con) {
                if(!empty($_POST['searchbox'])) {
                    $mem = 0;
                    $value = $_POST['searchbox'];
                    echo "<p class=\"sr\">Searching for: \" ".$value." \" </p>";
                    $squery = "SELECT * FROM profile WHERE profile_name like('%$value%')";
                    $sresult = mysqli_query($con, $squery);
                    $count = mysqli_num_rows($sresult);
                    if($count == 0) {
                        echo "<p id=\"success-msg\">No Friends to Show!</p>";
                    }
                    if(!$sresult) {
                        echo "failed !";
                    }else {
                        while($srow = mysqli_fetch_array($sresult)) {
                            $pid = $srow['profile_id'];
                            $uid = $_SESSION['user_id'];

                            $query = "SELECT * FROM profile WHERE profile_id = $pid && NOT user_id = $uid";
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
                <a href="seeprofile.php?id=<?php echo $row['user_id']?>">View Profile</a>
            </li>
        </ul>
        <?php
                }
                if($mem == 0) {
                    echo "No Firends to Display !";
                }
            }
            }
            }else {
            echo "Enter Something to Search!";
            }
            }
        ?>
    </div>
</div>



<?php require_once('footer.php')?>
