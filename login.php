<?php session_start(); ?>
<?php require_once('header.php')?>
<?php require_once('database.php')?>

<?php

if(isset($_POST['submit']) && !empty($_POST['submit']))
{
	SignIn($con);
}

if(isset($_POST['register']) && !empty($_POST['register']))
{
	Registration($con);
}

function Registration($con) {

    if(!empty($_POST['rname']) && !empty($_POST['remail']) && !empty($_POST['rpass'])) {
        $username = $_POST['rname'];
        $email = $_POST['remail'];
        $password = $_POST['rpass'];

        $query1 = "INSERT INTO user (`user_id`, `username`, `email`, `password`, `status`) VALUES (NULL, '$username', '$email', '$password', '0');";

        $result1 = mysqli_query($con, $query1);

        if(!$result1) {
            echo "database Query failed! ";
        }else {
            echo "<p id='success-msg'>Registration Successful !  Please Login Now :)</p>";
        }

    }
}

function SignIn($con)
{

    if(!empty($_POST['user']) && !empty($_POST['pass']))
    {
        $username = $_POST['user'];
        $password = $_POST['pass'];

        $query = "SELECT * FROM user WHERE username='$username' AND password='$password'";

        $result = mysqli_query($con, $query);

        if(!$result) {
            echo "database Query failed! ";
        }

        $row = mysqli_fetch_array($result);

        $db_user = $row['username'];
        $db_pass = $row['password'];
		$status = $row['status'];
		$db_user_id = $row['user_id'];

        if(($username == $db_user) && ($password == $db_pass) && $status == 0) {
            $_SESSION['user'] = $username;
			$_SESSION['user_id'] = $db_user_id;
            header("Location: home.php");
            exit;
		}elseif($status != 0) {
			echo "<p id='failure-msg'>You Have Been Blocked Temporarily !</p>";
		}else {
            echo "<p id='failure-msg'>Login Failed, Enter Correct Information !</p>";
        }

    } else {
            echo "<p id=\"vallogin\">fill all the information !</p>";
        }
}

?>

<div class="pen-title">
  <h1>Bony Chottor Login Panel</h1>
</div>
<div class="rerun"><a href="index.php">Back 2 Home</a></div>
<div class="container">
  <div class="card"></div>
  <div class="card">
    <h1 class="title">Login</h1>

    <form method="post" action="login.php">
      <div class="input-container">
        <input name="user" type="text" id="Username" required="required"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input name="pass" type="password" id="Password" required="required"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="button-container">
        <!-- <button><span>Go</span></button> -->
        <input type="submit" name="submit" class="login-btn" value="login">
      </div>
      <div class="footer"><a href="#">" Register First to Login "</a></div>
    </form>

  </div>


  <div class="card alt">
    <div class="toggle"></div>
    <h1 class="title">Register
      <div class="close"></div>
    </h1>
    <form method="post" action="login.php">
      <div class="input-container">
        <input name="rname" type="text" id="Username" required="required"/>
        <label for="Username">Username</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input name="remail" type="email" id="Password" required="required"/>
        <label for="Password">Email</label>
        <div class="bar"></div>
      </div>
      <div class="input-container">
        <input name="rpass" type="password" id="Password" required="required"/>
        <label for="Password">Password</label>
        <div class="bar"></div>
      </div>
      <div class="reg-container">
        <input type="submit" name="register" class="reg-btn" value="Register">
      </div>
    </form>
  </div>
</div>


<?php require_once('footer.php')?>
