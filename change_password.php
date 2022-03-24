<?php
  include "connect.php";
  session_start();
  if($_SESSION["status"] != "active") {
    header("Location: index.php");
  }
  $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body>
    <div class="change_password">
      <i class="fas fa-lock"></i> <h1>&nbsp;Change Password</h1>
      <hr />
      <div class="row">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="col-md-12">
            <div class="form-group">
              <label>Old Password</label>
              <input type="password" name="old_password" class="form-control" placeholder="Old Password" required oninvalid="this.setCustomValidity('Old Password is required')"
              oninput="this.setCustomValidity('')"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>New Password</label>
              <input type="password" name="new_password" class="form-control" placeholder="New Password" required oninvalid="this.setCustomValidity('New Password is required')"
              oninput="this.setCustomValidity('')"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>Confirm New Password</label>
              <input type="password" name="confirm_new_password" class="form-control" placeholder="Confirm New Password" required oninvalid="this.setCustomValidity('Password Confirmation is required')"
              oninput="this.setCustomValidity('')"/>
            </div>
          </div>
          <div class="col-md-3">
            <a href="#">Forgot Password?</a>
          </div>
          <div style="padding-top:15px;" class="col-md-12">
            <button name="update_password" class="btn btn-primary">Update Password</button>
          </div>
        </form>
        <!-- Modal To Cover Upload -->
        <div id="myModal" class="modal fade" role="dialog">
          <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
              <div class="modal-header">
                <?php
                    if($_SERVER["REQUEST_METHOD"]=="POST") {
                      if(isset($_POST["update_password"])) {
                        $old_password = $_REQUEST["old_password"];
                        $new_password = $_REQUEST["new_password"];
                        $confirm_new_password = $_REQUEST["confirm_new_password"];

                        $password = mysqli_query($conn, "SELECT `user_password` FROM `user_info` WHERE `user_id` = $user_id");

                        $row=mysqli_fetch_array($password);
                         if($row['user_password']==$old_password && $new_password == $confirm_new_password) {
                           $update_password = mysqli_query($conn, "UPDATE `user_info` SET `user_password` = '$new_password' where `user_id` = '$user_id'");
                           echo "<script>alert('Password Changed Successfully.');window.location.href='about.php#!/change_password';</script>";
                          } else {
                          echo "<script>alert('Wrong Values Entered. Password could not be changed.');window.location.href='about.php#!/change_password';</script>";
                        }
                      }
                    }
                  ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </body>
</html>
