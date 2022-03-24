<?php
  include "connect.php";
  session_start();
  if($_SESSION["status"] != "active") {
    header("Location: index.php");
  }
  $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];

  $sql = mysqli_query($conn, "CALL get_user_info($user_id)");
  $row = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Allian: Update Info</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <div class="basic_info">
      <div class="upload">

        <form style="padding-right:200px;" method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label class="btn btn-primary" for="dp_btn"><i class="far fa-images"></i>&ensp;Select Profile Pic</label>
          <input id="dp_btn" type="file" name="dp_btn" />
          <button type="submit" class="btn" name="btn_upload_profile"><i class="fas fa-upload"></i>&ensp;Profile Upload</button>
        </form>
        
        <form  method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <label class="btn btn-primary" for="cover_btn"><i class="far fa-images"></i>&ensp;Select Profile Cover</label>
          <input id="cover_btn" type="file" name="cover_btn" />
          <button type="submit" class="btn" name="btn_upload_cover"><i class="fas fa-upload"></i>&ensp;Cover Upload</button>
        </form>

        <!-- Modal To Cover Upload -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <?php
                  require "upload.php";
                  require "upload_cover.php";
                ?>
              </div>
            </div>
          </div>
        </div>
      </div>
      <hr />
      <div class="row">
        <form method="post" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="col-md-6">
            <div class="form-group">
              <label>First Name</label>
              <input class="form-control" type="text" name="first_name" placeholder="First Name" value="<?php
                      echo $row["first_name"];
                    ?>" />
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Last Name</label>
              <input class="form-control" type="text" name="last_name" placeholder="Last Name"
              value="<?php
                      echo $row["last_name"];
                    ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Email</label>
              <input class="form-control" type="email" name="email" placeholder="Email"
              value="<?php
                      echo $row["email"];
                    ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <label>Date of Birth</label>
          </div>
          <div class="col-md-12">
            <input type="date" class="form-control" name="dob"
            value="<?php
                    echo $row["dob"];
                  ?>">
          </div>
          <div class="col-md-12">
            <br />
            <label>Gender</label>
            <br />
            <label class="radio-inline">
             <input type="radio" name="gender" value="male"
                <?php
                   if($row['gender'] == "male") {
                     echo "checked";
                   }
                 ?> />Male
           </label>
           <label class="radio-inline">
             <input type="radio" name="gender" value="female"
                  <?php
                     if($row['gender'] == "female") {
                       echo "checked";
                     }
                 ?> />Female
           </label>
           <label class="radio-inline">
             <input type="radio" name="gender" value="other"
                <?php
                     if($row['gender'] == "other") {
                       echo "checked";
                     }
                 ?> />Other
           </label>
           <br />
           <br />
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>City</label>
              <input class="form-control" type="text" name="city" placeholder="Your city"
              value="<?php
              echo $row["city"];
                    ?>" />
            </div>
          </div>
          <div class="col-md-12">
            <label>About Me</label>
            <textarea name="about_me" class="form-control" rows="5" maxlength="1000"><?php echo $row["about_me"]; ?></textarea>
          </div>
          <div class="col-md-12">
            <br />
            <button style="width:100%; border-radius: 18px;" type="submit" name="btn_save_changes" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
        <?php
          ob_start();
          if($_SERVER["REQUEST_METHOD"]=="POST") {
            if(isset($_POST["btn_save_changes"])) {
              $first_name = $_REQUEST["first_name"];
              $last_name = $_REQUEST["last_name"];
              $email = $_REQUEST["email"];
              $dob = $_REQUEST["dob"];
              $gender = $_REQUEST["gender"];
              $city = $_REQUEST["city"];
              $about_me = $_REQUEST["about_me"];

              $register = mysqli_query($conn,"UPDATE `user_info` SET `first_name`='$first_name',`last_name`='$last_name',`email`='$email',`dob`='$dob',`gender`='$gender',`city`='$city', `about_me` = '$about_me' WHERE `user_id` = $user_id");
            }
            header("Location: about.php#!/"); /* Redirect browser */
            ob_end_flush();
            exit();
          }
        ?>
      </div>
    </div>
  </body>
</html>
