<?php session_start(); ?>
<?php require_once("header.php")?>
<?php require_once("database.php")?>
<?php require_once("home-header.php")?>
<?php require_once("sidebar.php")?>


<?php

    if(!$_SESSION['user'])
    {
        header('Location: login.php');
    }

    if(isset($_POST['submit']))
    {
        edit_profile($con);
    }

    function edit_profile($con) {

        if(!empty($_POST['pname']) && !empty($_FILES['image']['tmp_name']) )
        {
            $ok = "1";
            $user_id = $_SESSION['user_id'];
            $name = $_POST['pname'];
            $title = $_POST['ptitle'];
            $about = $_POST['pabout'];
            $hobby = $_POST['phb'];
            $education = $_POST['ped'];
            $experience = $_POST['pex'];

            $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
            $image_name = $_FILES['image']['name'];
            $image_size = getimagesize($_FILES['image']['tmp_name']);


            if(!$insert = mysqli_query($con, "INSERT INTO `profile`
                (`profile_id`, `user_id`, `p_ok`, `profile_name`, `profile_title`, `profile_about`, `profile_hobby`, `profile_education`, `profile_experience`, `profile_pic`)
                VALUES
                (NULL, '$user_id', '$ok', '$name', '$title', '$about', '$hobby', '$education', '$experience','$image')"))
            {
                echo "<p id=\"failure-msg\">Problem Uploading !</p>". mysql_error();
            } else {
                header("Location: profile.php");
                exit;
            }

        } else {

            echo "<p id=\"failure-msg\">Fill All The Information !</p>";

        }
    }
?>



<section>
    <div class="pf-body">
        <h1 class="heading">Edit Your Profile: </h1>

        <form action="#" method="post" class="pform" name="editpf" enctype="multipart/form-data">
            <p id="pname" class="formlabel">Profile Name: </p>
            <input type="text" name="pname" size="100" placeholder="Enter profile Name" required="required">

            <p id="pname" class="formlabel">Profile title: </p>
            <input type="text" name="ptitle" size="100" placeholder="Enter Profile Title" required="required">

            <p class="formlabel">About Me: </p>
            <textarea name="pabout" id="pabout" cols="76" rows="15" wrap="soft" required="required" placeholder="Enter About Yourself..."></textarea>

            <p id="phb" class="formlabel">My Hobbies: </p>
            <input type="text" name="phb" size="100" placeholder="Enter Your Hobbies" required="required">

            <p id="ped" class="formlabel">My Educations: </p>
            <input type="text" name="ped" size="100" placeholder="Enter Your Educations" required="required">

            <p id="pex" class="formlabel">My Experiences: </p>
            <input type="text" name="pex" size="100" placeholder="Enter Your Experiences" required="required">

            <p id="ppic" class="formlabel">Profile Picture: </p>
            <input type="file" name="image" placeholder="Select An Image" accept="image/*" onchange="loadFile(event)" required="required">
            <img id="output"/>
            <script>
              var loadFile = function(event) {
                var reader = new FileReader();
                reader.onload = function(){
                  var output = document.getElementById('output');
                  output.src = reader.result;
                };
                reader.readAsDataURL(event.target.files[0]);
              };
            </script>

            <input type="submit" name="submit" value="Update Profile" id="pfsubmit">
        </form>

    </div> <!-- /#main-body -->
</section>

<?php require_once("footer.php")?>
