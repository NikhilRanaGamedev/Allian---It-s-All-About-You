<?php
  include "connect.php";
  session_start();
  if($_SESSION["status"] != "active") {
    header("Location: index.php");
  }
  $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];

  $sql = mysqli_query($conn, "SELECT * FROM `account_settings` WHERE `user_id` = $user_id");
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
  </head>
  <body>
    <div class="account_settings">
      <i class="fas fa-sliders-h"></i> <h1>&nbsp;Account Settings</h1>
      <hr />
      <div class="row">
        <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        <div class="col-md-7">
          <label>Enable Follow Me</label>
          <p>
            Enable this if you want people to follow you
          </p>
        </div>
        <div class="col-md-5">
          <label class="switch">
            <input name="enable_follow_me" type="checkbox"
                <?php
                    if($row['enable_follow_me'] == "1") {
                      echo "checked";
                    }
                ?> value="1"/>
            <span class="slider round"></span>
          </label>
        </div>
        <div class="col-md-7">
          <label>Send me notifications</label>
          <p>
            Send me notification emails my friends like, share or message me
          </p>
        </div>
        <br />
        <div class="col-md-5">
          <label class="switch">
            <input name="send_me_notifications" type="checkbox"
                <?php
                    if($row['send_me_notifications'] == "1") {
                      echo "checked";
                    }
                ?> value="1"/>
            <span class="slider round"></span>
          </label>
        </div>
        <div class="col-md-7">
          <label>Text messages</label>
          <p>
            Send me messages to my cell phone
          </p>
        </div>
        <br />
        <div class="col-md-5">
          <label class="switch">
            <input name="text_messages" type="checkbox"
                <?php
                    if($row['text_messages'] == "1") {
                      echo "checked";
                    }
                ?> value="1"/>
            <span class="slider round"></span>
          </label>
        </div>
        <div class="col-md-7">
          <label>Enable tagging</label>
          <p>
            Enable my friends to tag me on their posts
          </p>
        </div>
        <br />
        <div class="col-md-5">
          <label class="switch">
            <input name="enable_tagging" type="checkbox"
                <?php
                    if($row['enable_tagging'] == "1") {
                      echo "checked";
                    }
                ?> value="1"/>
            <span class="slider round"></span>
          </label>
        </div>
        <div class="col-md-7">
          <label>Enable sound</label>
          <p>
            You'll hear notification sound when someone sends you a private message
          </p>
        </div>
        <br />
        <div class="col-md-5">
          <label class="switch">
            <input name="enable_sound" type="checkbox"
                <?php
                    if($row['enable_sound'] == "1") {
                      echo "checked";
                    }
                ?> value="1"/>
            <span class="slider round"></span>
          </label>
        </div>
        <div class="col-md-12">
          <button style="width:65%;" type="submit" name="btn_account_settings_update" class="btn btn-primary">Save Changes</button>
        </div>
      </form>
      <?php
        ob_start();
        if($_SERVER["REQUEST_METHOD"]=="POST") {
          if(isset($_POST["btn_account_settings_update"])) {

            if($_POST['enable_follow_me'] == '1') {
              $enable_follow_me = "1";
            } else {
              $enable_follow_me = "0";
            }

            if($_POST['send_me_notifications'] == '1') {
              $send_me_notifications = "1";
            } else {
              $send_me_notifications = "0";
            }

            if($_POST['text_messages'] == '1') {
              $text_messages = "1";
            } else {
              $text_messages = "0";
            }

            if($_POST['enable_tagging'] == '1') {
              $enable_tagging = "1";
            } else {
              $enable_tagging = "0";
            }

            if($_POST['enable_sound'] == '1') {
              $enable_sound = "1";
            } else {
              $enable_sound = "0";
            }

            $update_account_settings = mysqli_query($conn, "UPDATE `account_settings` SET `enable_follow_me` = '$enable_follow_me', `send_me_notifications` = '$send_me_notifications', `text_messages` = '$text_messages', `enable_tagging` = '$enable_tagging', `enable_sound` = '$enable_sound' where user_id = $user_id");
            header("Location: about.php#!/account_settings");
            ob_end_flush();
            exit();
          }
        }
      ?>
      </div>
    </div>
  </body>
</html>
