<?php
  ob_start();
  include "connect.php";
  session_start();
  if($_SESSION["status"] != "active") {
    header("Location: index.php");
  }
  $user_id = $_SESSION["user_id"];

  $education_sql = mysqli_query($conn, "SELECT * FROM `education_info` WHERE `user_id` = $user_id");
  $education_row = mysqli_fetch_assoc($education_sql);

  $company_sql = mysqli_query($conn, "SELECT * FROM `work_info` WHERE `user_id` = $user_id");
  $company_row = mysqli_fetch_assoc($company_sql);
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
    <div class="education_work">
      <i class="fas fa-graduation-cap"></i> <h1>&nbsp;My Education</h1>
      <hr />
      <div class="row">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="col-md-12">
            <div class="form-group">
              <label>My Education</label>
              <input type="text" class="form-control" name="myUniversity" placeholder="My University" value="<?php
                      echo $education_row["education_university"];
                    ?>"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>From</label>
              <input type="text" name="education_from" class="form-control" placeholder="From" value="<?php
                  echo $education_row["education_from"];
                ?>"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>To</label>
              <input type="text" name="education_to" class="form-control" placeholder="From" value="<?php
                  echo $education_row["education_to"];
                ?>"/>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="education_description" name="texts" cols="30" rows="5" class="form-control" placeholder="Write what you wish"><?php echo $education_row["education_description"];?></textarea>
            </div>
          </div>
          <div class="col-md-3">
            <div class="form-group">
              <label>Graduated: </label>
              <input type="radio" name="graduated" value="1"
                  <?php
                    if($education_row['graduated'] == "1") {
                      echo "checked";
                    }
                  ?>> Yes
              <input type="radio" name="graduated" value="0"
                  <?php
                    if($education_row['graduated'] == "0") {
                      echo "checked";
                    }
                  ?> /> No
            </div>
          </div>
          <div class="col-md-12">
            <button type="submit" name="btn_education_update" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
        <?php
          if($_SERVER["REQUEST_METHOD"]=="POST") {
            if(isset($_POST["btn_education_update"])) {
              $education_university = $_REQUEST["myUniversity"];
              $education_from = $_REQUEST["education_from"];
              $education_to = $_REQUEST["education_to"];
              $education_description = $_REQUEST["education_description"];
              if($_POST['graduated'] == '1') {
                $education_grdauated = 1;
              } else {
                $education_grdauated = 0;
              }

              $update_education = mysqli_query($conn, "UPDATE `education_details` SET `education_university` = '$education_university', `education_from` = '$education_from', `education_to` = '$education_to', `education_description` = '$education_description', `graduated` = '$education_grdauated' where user_id = $user_id");

              header("Location: about.php#!/education_work");
              // ob_end_flush();
            }
          }
        ?>
      </div>
      <br />
      <i class="fas fa-briefcase"></i> <h1>Work Experiences</h1>
      <hr />
      <div class="row">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="col-md-12">
            <div class="form-group">
              <label>Company</label>
              <input name="company_name" type="text" class="form-control" placeholder="Company" value="<?php
                      echo $company_row["company_name"];
                    ?>"/>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Designation</label>
              <input name="company_designation" type="text" class="form-control" placeholder="Designation" value="<?php
                      echo $company_row["company_designation"];
                    ?>"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>From</label>
              <input name="company_from" type="text" class="form-control" placeholder="From" value="<?php
                      echo $company_row["company_from"];
                    ?>"/>
            </div>
          </div>
          <div class="col-md-6">
            <div class="form-group">
              <label>To</label>
              <input name="company_to" type="text" class="form-control" placeholder="From" value="<?php
                      echo $company_row["company_to"];
                    ?>"/>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>City/Town</label>
              <input name="company_place" type="text" class="form-control" placeholder="City/Town" value="<?php
                      echo $company_row["company_place"];
                    ?>"/>
            </div>
          </div>
          <div class="col-md-12">
            <div class="form-group">
              <label>Description</label>
              <textarea name="company_description" cols="30" rows="5" class="form-control" placeholder="Write what you wish"><?php echo $company_row["company_description"];?></textarea>
            </div>
          </div>
          <div class="col-md-12">
            <button name="btn_company_update" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
        <?php
          if($_SERVER["REQUEST_METHOD"]=="POST") {
            if(isset($_POST["btn_company_update"])) {
              $company_name = $_REQUEST["company_name"];
              $company_designation = $_REQUEST["company_designation"];
              $company_from = $_REQUEST["company_from"];
              $company_to = $_REQUEST["company_to"];
              $company_place = $_REQUEST["company_place"];
              $company_description = $_REQUEST["company_description"];

              $update_company = mysqli_query($conn, "UPDATE `company_details` SET `company_name` = '$company_name', `company_designation` = '$company_designation', `company_from` = '$company_from', `company_to` = '$company_to', `company_place` = '$company_place', `company_description` = '$company_description' where user_id = $user_id");
              header("Location: about.php#!/education_work");
            }
          }
        ?>
      </div>
    </div>
  </body>
</html>
