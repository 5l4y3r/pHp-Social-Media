<div class="home-main clearfix">
    <div class="home-half">
        <a id="home-title" href="home.php">Bony Chottor</a>
        <div class="search-box">
            <form class="search-form" action="search.php" method="post">
                <input name="searchbox" placeholder="search bony members..." type="text" id="search-field"/>
                <input type="submit" name="search" id="search-btn" value="search">
            </form>
        </div>
    </div>
    <div class="home-other-half">
        <ul class="home-list clearfix">
            <?php
                $cuser = $_SESSION['user_id'];
                if ($cuser == 17) {
             ?>
             <li><a title="Admin Control" href="admin-control.php"><i class="fa fa-cogs" aria-hidden="true"></i>
 </a></li>
            <?php
        }
            ?>

            <li><a title="My Profile"  href="profile.php"><i class="fa fa-user" aria-hidden="true"></i>
</a></li>

            <li><a title="Logout"  href="logout.php"><i class="fa fa-sign-out" aria-hidden="true"></i></a></li>
        </ul>
    </div>
</div>
