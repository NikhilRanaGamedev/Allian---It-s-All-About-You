<?php
  include "connect.php";
  session_start();
  if($_SESSION["status"] != "active") {
    header("Location: index.php");
  }
  $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];

  $sql = mysqli_query($conn, "SELECT `interest` FROM `user_interests` WHERE `user_id` = $user_id");
  $row = mysqli_fetch_assoc($sql);
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
    <link rel="stylesheet" href="js\bootstrap-tagsinput\dist\bootstrap-tagsinput.css" />
    <script type="text/javascript">
      function stopRKey(evt) {
        var evt = (evt) ? evt : ((event) ? event : null);
        var node = (evt.target) ? evt.target : ((evt.srcElement) ? evt.srcElement : null);
        if ((evt.keyCode == 13) && (node.type=="text"))  {return false;}
      }
      document.onkeypress = stopRKey;
    </script>
  </head>
  <body>
    <div class="interests">
      <i class="far fa-heart"></i> <h1>&nbsp;My Interests</h1>
      <hr />
      <?php
        $getInterest = mysqli_query($conn, "SELECT COUNT(interest) FROM `user_interests` WHERE `user_id` = $user_id");
        $interestResult = mysqli_fetch_assoc($getInterest);
        echo $interestResult["COUNT(*)"];
        if($row['interest'] != null) {
            for($i = 0; $i < 10; $i++) {
              echo "<button style='width:150px; margin-left: 1%;' class='btn btn-success'>$row[$i]</button>";
            }
          } else {
            echo "<h3 style='color: #E86043;'>
              You have no interests entered yet!
            </h3>";
          }
      ?>
      <hr />
      <div class="row">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="col-md-7">
            <div class="form-group">
              <label>Add Interests</label>
              <br />
              <input style="width:40%;" type="text" name="interests_tags" data-role="tagsinput" class="form-control" placeholder="Interests" value="<?php
                      echo $row['interest'];
                  ?>"/>
            </div>
          </div>
          <div class="col-md-5" style="padding:20px;">
            <button name="btn_interests_update" class="btn btn-primary">Add</button>
          </div>
        </form>
        <?php
          if($_SERVER["REQUEST_METHOD"]=="POST") {
            if(isset($_POST["btn_interests_update"])) {
              $interests_tags = $_REQUEST["interests_tags"];

              $insert_interests = mysqli_query($conn, "INSERT INTO `user_interests`(`user_id`, `interest`) VALUES($user_id, '$interests_tags')");
            }
            header("Location: about.php#!/my_interests");
          }
        ?>
      </div>
    </div>
    <script src="js\bootstrap-tagsinput\dist\bootstrap-tagsinput.min.js"></script>
  </body>
</html>
