<?php
  include "connect.php";
  session_start();
  if($_SESSION["status"] != "active") {
    header("Location: index.php");
  }
  $user_id = $_SESSION["user_id"];
  $username = $_SESSION["username"];

  $sql = mysqli_query($conn, "SELECT * FROM `user_info` WHERE `user_id` = $user_id");
  $row = mysqli_fetch_assoc($sql);

  $post_id_query = mysqli_query($conn, "SELECT MAX(`post_id`) FROM `user_posts` WHERE `user_id` = $user_id");
  $post_id_row = mysqli_fetch_assoc($post_id_query);

  error_reporting(0);
  ini_set('display_errors', 0);
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Allian: Newfeed</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
  </head>
  <body ng-app="MyApp" ng-controller="MyController">
    <!-- Navbar -->
    <nav id="navbar" class="nav navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="icon-bar"></i>
            <i class="icon-bar"></i>
            <i class="icon-bar"></i>
          </button>
          <a class="navbar-brand" href="timeline.php"><img class="img-responsive" src="images/logo.jpg" /></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="newsfeed.php" class="active">Newsfeed</a>
            </li>
            <li>
              <a href="timeline.php">Timeline</a>
            </li>
            <li>
              <a href="#">Notifications</a>
            </li>
            <li>
              <a href="#">Contact</a>
            </li>
          </ul>
          <form class="navbar-form navbar-right hidden-sm">
            <div class="form-group">
              <i class="fas fa-search"></i>
              <input type="text" class="form-control" placeholder="Search friends, photos, videos">
            </div>
          </form>
        </div>
      </div>
    </nav>

    <div class="newsfeed">
      <!-- SideBar -->
      <div class="side_bar">
        <div class="person">
          <img src="<?php
          echo $row['profile_pic'];
          ?>" />
          <h5><?php
                  echo $row['first_name']." ".$row['last_name'];
              ?></h5>
        </div>
        <div class="menu list-inline">
          <ul>
            <li>
              <i style="color:#8dc63f;" class="fas fa-newspaper"></i><a href="#" class="active"> Newsfeed</a>
            </li>
            <li>
              <i style="color:#662d91;" class="fas fa-users"></i><a href="#"> People Nearby</a>
            </li>
            <li>
              <i style="color:#ee2a7b;" class="fas fa-user-friends"></i><a href="#"> Friends</a>
            </li>
            <li>
              <i style="color:#f7941e;" class="fas fa-comments"></i><a href="#"> Messages</a>
            </li>
            <li>
              <i style="color:#1c75bc;" class="fas fa-images"></i><a href="#"> Gallery</a>
            </li>
          </ul>
        </div>
        <div class="online">
          <button class="btn btn-success">Chat Online</button>
          <div class="people_online">
            <ul class="list-inline">
              <li>
                <a href="#"><img src="images/person_1.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_2.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_3.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_4.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_5.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_6.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_7.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_8.png" /></a>
              </li>
              <li>
                <a href="#"><img src="images/person_9.png" /></a>
              </li>
            </ul>
          </div>
        </div>
      </div>

      <!-- Newsfeed -->
      <div class="newsfeed_body">
        <div class="status_update">
          <form method="POST" enctype="multipart/form-data" action="<?php echo $_SERVER['PHP_SELF']; ?>">
          <div class="row">
            <div style="margin: 0 10px;" class="col-md-1">
              <img src="<?php
                echo $row['profile_pic'];
              ?>" />
            </div>
            <div class="col-md-5">
              <textarea id="post_msg" name="post_msg" cols="30" rows="2" class="form-control" placeholder="Write what you wish"></textarea>
            </div>
            <div class="col-md-3">
              <ul class="list-inline">
                <li>
                  <input id="post_image" type="file" class="form-control" name="post_image" accept="image/x-png,image/gif,image/jpeg"/>
                  <label for="post_image"><i class="far fa-images"></i></label>
                </li>
                <li>
                  <input id="post_video" type="file" class="form-control" name="post_video" accept="video/*"/>
                  <label for="post_video"><i class="fas fa-video"></i></label>
                </li>
                <li>
                  <i class="fas fa-map-marked-alt" onclick="getLocation();"></i>
                </li>
              </ul>
            </div>
            <div style="padding: 10px 0;" class="col-md-1">
              <button type="submit" id="publish" name="publish" class="btn btn-primary" data-snnode="post_image">Publish</button>
            </div>
          </div>
        </form>
        <?php
        if($_SERVER["REQUEST_METHOD"]=="POST") {
          if(isset($_POST["publish"])) {
            $date = date("jS F");
            date_default_timezone_set('Asia/Kolkata');
            $time = date("h:i:s");
            $post_msg = $_REQUEST["post_msg"];
            $post_image = $_REQUEST["post_image"];
            $post_video = $_REQUEST["post_video"];
            $post_id = $post_id_row["MAX(`post_id`)"];
            $post_id++;
            if($_FILES['post_image']['name'] == "")
            {
              $post_image_path = NULL;
            } else {
              $post_image_path = "users/".$username."/posts_pics/$post_id.jpg";
            }

            include "post_upload.php";

            if(!isset($_SESSION['err_broken']) || !isset($_SESSION['err_size']) || !isset($_SESSION['err_type']) || !isset($_SESSION['err']) || !isset($_SESSION['err_fail'])) {
              $post_upload = mysqli_query($conn, "INSERT INTO `user_posts`(`user_id`, `post_id`, `date`, `time`, `post_msg`, `img`, `video`) VALUES($user_id, $post_id, '$date', '$time', '$post_msg', '$post_image_path', '$post_video')");
            }

            if($post_upload == true) {
              $_SESSION["post_success"] = 1;
            } else {
              $_SESSION["post_fail"] = 1;
            }
            }
            header("Location: newsfeed.php");
          }
        ?>
      </div>
      <?php
        if(isset($_SESSION['err_broken'])){
          echo "<p style='color:#D54224;padding:0px 5.5em;'>
             Invalid Image! Either file is not image type or the file is broken.
           </p>";
         unset($_SESSION['err_broken']);
       }
        if(isset($_SESSION['err_size'])){
          echo "<p style='color:#D54224;padding:0px 5.5em;'>
             Image size cannot excede 10MB.
           </p>";
          unset($_SESSION['err_broken']);
        }
        if(isset($_SESSION['err_type'])){
          echo "<p style='color:#D54224;padding:0px 5.5em;'>
            File is not of image type.
          </p>";
         unset($_SESSION['err_type']);
        }
        if(isset($_SESSION['err'])){
           echo "<p style='color:#D54224;padding:0px 5.5em;'>
             An error occured. Your file could not be uploaded.
           </p>";
          unset($_SESSION['err']);
        }
        if(isset($_SESSION['upload_success']) || $_SESSION['post_success']){
           echo "<p style='color:#1AB748;padding:0px 5.5em;'>
             Your post has been posted succesfully!
           </p>";
          unset($_SESSION['upload_success']);
          unset($_SESSION['post_success']);
        }
        if(isset($_SESSION['err_fail'])){
           echo "<p style='color:#D54224;padding:0px 5.5em;'>
             An error occured. Your file could not be uploaded.
           </p>";
          unset($_SESSION['err_fail']);
        }

        if(isset($_SESSION['post_fail'])){
           echo "<p style='color:#D54224;padding:0px 5.5em;'>
             Your post could not be uploaded.
           </p>";
          unset($_SESSION['post_fail']);
        }
      ?>
      <div class="newsfeed_post">
        <?php
          $post_id = $post_id_row["MAX(`post_id`)"];
          for($i = 0; $i<$post_id; $post_id--) {
            $sql = mysqli_query($conn, "SELECT * FROM `user_info` WHERE `user_id` = $user_id");
            $row = mysqli_fetch_assoc($sql);
            echo "<img src='".$row['profile_pic']."'style='border-radius: 100%;height: 50px;'/>";
            echo str_repeat("&nbsp;", 3.5);
            $sql = mysqli_query($conn, "SELECT * FROM `user_info` WHERE `user_id` = $user_id");
            $sql_post = mysqli_query($conn, "SELECT * FROM `user_posts` WHERE `user_id` = $user_id && `post_id` = $post_id");
            $post = mysqli_fetch_assoc($sql_post);
            while($row = mysqli_fetch_assoc($sql)) {
                if($row["gender"] == "male") {
                  $gender = "his";
                } else {
                  $gender = "her";
                }
              $name = $row['first_name']." ".$row['last_name'];
              echo "<a href='#' style='text-decoration:none;'>$name</a> posted on $gender status.";
            }
            echo "<p style='padding: 0 0 0 6.25em;font-size:10px;'>".$post['date']." ".$post['time']."</p>";
            echo "<p style='padding: 0 0 0 4.4em;'>".$post['post_msg']."</p>";
            if($post['img'] != NULL)
            {
              echo "<img src='".$post['img']."' style='padding:0 0 0 4.5em;max-width:100%;max-height:100%;' />";
              echo "<br />";
            }
            echo "<i style='padding: 10px 0 0 3.2em;font-size:20px;' class='far fa-thumbs-up eff'></i> Like";
            echo "<i style='padding: 10px 0 0 15px; font-size:20px;' class='far fa-comments'></i> Comment";
            echo "<i style='padding: 10px 0 0 15px; font-size:20px;' class='far fa-share-square'></i> Share";
            echo "<br><br>";
          }
        ?>
      </div>
      </div>
    </div>


    <!-- Preloader -->
    <div id="spinner-wrapper">
      <div class="spinner"></div>
    </div>

    <!--Scripts
    ============================================================-->
		<script src="js/jquery.min.js"></script>
	  <script src="js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
