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

    global $id;
    $id = $_REQUEST['id'];

    if(isset($_POST['submit']))
    {
        update_profile($con);
    }

    function update_profile($con) {

        if(!empty($_POST['pname']) && !empty($_POST['ptitle'])
        && !empty($_POST['pabout']) &&  !empty($_POST['phb'])
        && !empty($_POST['ped']) && !empty($_POST['pex']))
        {
            $ok = "1";
            $user_id = $_SESSION['user_id'];
            $name = $_POST['pname'];
            $title = $_POST['ptitle'];
            $about = $_POST['pabout'];
            $hobby = $_POST['phb'];
            $education = $_POST['ped'];
            $experience = $_POST['pex'];

            if(!empty($_FILES['image']['tmp_name']))
            {
                global $id;

                $image = addslashes(file_get_contents($_FILES['image']['tmp_name']));
                $image_name = $_FILES['image']['name'];
                $image_size = getimagesize($_FILES['image']['tmp_name']);

                if(!$insert = mysqli_query($con, "UPDATE profile SET profile_name ='$name', profile_title ='$title', profile_about ='$about', profile_hobby ='$hobby', profile_education ='$education', profile_experience ='$experience', profile_pic ='$image' WHERE user_id = $id "))
                    {
                        echo "<p id=\"failure-msg\">Problem Uploading !</p>";
                    } else {
                        echo "<p id=\"success-msg\">Profile Updated!</p>";
                    }
            }else {
                global $id;
                if(!$insert = mysqli_query($con, "UPDATE profile SET profile_name ='$name', profile_title ='$title', profile_about ='$about', profile_hobby ='$hobby', profile_education ='$education', profile_experience ='$experience' WHERE user_id = $id "))
                    {
                        echo "<p id=\"failure-msg\">Problem Uploading !</p>";
                    } else {
                        echo "<p id=\"success-msg\">Profile Updated!</p>";
                    }
            }

        } else {

            echo "<p id=\"failure-msg\">Fill All The Information !</p>";

        }
    }
?>



<section>
    <div class="pf-body">
        <h1 class="heading">Edit Your Profile: </h1>

        <?php
            $query = "SELECT * FROM profile WHERE user_id = '$id'";
            $result = mysqli_query($con, $query);
            if(!$result) {
                echo "Query Failed !";
            }
            while($row = mysqli_fetch_array($result)) {
        ?>

        <form action="#" method="post" class="pform" name="editpf" enctype="multipart/form-data">
            <p id="pname" class="formlabel">Profile Name: </p>
            <input type="text" name="pname" size="100" value="<?php echo $row['profile_name']?>" placeholder="Enter profile Name" required="required">

            <p id="pname" class="formlabel">Profile title: </p>
            <input type="text" name="ptitle" size="100" value="<?php echo $row['profile_title']?>" placeholder="Enter Profile Title" required="required">

            <p class="formlabel">About Me: </p>
            <textarea name="pabout" id="pabout" cols="76" rows="15" wrap="soft" required="required" placeholder="Enter About Yourself..."><?php echo $row['profile_about']?></textarea>

            <p id="phb" class="formlabel">My Hobbies: </p>
            <input type="text" name="phb" size="100" value="<?php echo $row['profile_hobby']?>" placeholder="Enter Your Hobbies" required="required">

            <p id="ped" class="formlabel">My Educations: </p>
            <input type="text" name="ped" size="100" value="<?php echo $row['profile_education']?>" placeholder="Enter Your Educations" required="required">

            <p id="pex" class="formlabel">My Experiences: </p>
            <input type="text" name="pex" size="100" value="<?php echo $row['profile_experience']?>" placeholder="Enter Your Experiences" required="required">

            <p id="ppic" class="formlabel">Current Profile Picture: </p>
            <?php echo "<img id=\"outputs\" src=get-profile-image.php?id=".$row['user_id'].">"; ?>

            <p id="ppic" class="formlabel">Update Profile Picture: </p>
            <input type="file" name="image" placeholder="Select An Image" accept="image/*" onchange="loadFile(event)">
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

        <?php
            }
        ?>


    </div> <!-- /#main-body -->
</section>

<?php require_once("footer.php")?>
