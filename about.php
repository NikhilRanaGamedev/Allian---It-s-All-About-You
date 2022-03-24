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
    <title>Allian: About</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<link type="text/css" rel="stylesheet" href="css/style.css" />
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
		<link rel="stylesheet" href="css/bootstrap.min.css" />
    <style>
      .profile {
        background: url("<?php
            echo $row['profile_cover'];
          ?>");
        background-position: center;
        background-size: cover;
        min-height: 300px;
        border-radius: 0 0 6px 6px;
        margin: 0 170px;
        padding: 15px;
      }
    </style>
  </head>
  <body ng-app="myApp">

    <!-- Navbar -->
    <nav id="navbar" class="nav navbar-default">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
            <i class="icon-bar"></i>
            <i class="icon-bar"></i>
            <i class="icon-bar"></i>
          </button>
          <a class="navbar-brand" href="#"><img class="img-responsive" src="images/logo.jpg" /></a>
        </div>
        <div class="collapse navbar-collapse" id="myNavbar">
          <ul class="nav navbar-nav navbar-right">
            <li>
              <a href="newsfeed.php">Newsfeed</a>
            </li>
            <li>
              <a href="#" class="active">Timeline</a>
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

    <!--Upload-->
    <div class="profile">
      <div class="name">
        <div class="profile_pic">
          <img src="<?php
              echo $row['profile_pic'];
            ?>" />
        </div>
        <h4><?php
              echo $row['first_name']." ".$row['last_name'];
            ?></h4>
        <p class="text-muted">Creative Director</p>
      </div>
        <div class="nav_menu">
          <div class="row">
            <div class="col-md-4 col-md-offset-4">
              <ul  class="list-group list-inline">
                <li><a href="timeline.php">Timeline</a></li>
                <li><a href="#" class="active">About</a></li>
                <li><a href="album.php">Album</a></li>
                <li><a href="#">Friends</a></li>
              </ul>
            </div>
            <div style="padding:15px 0;" class="col-md-2">
              <span>0 people following</span>
            </div>
            <div style="padding:8px;" class="col-md-2">
              <form method="POST" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                <button class="btn btn-primary" name="logout_btn">Log Out</button>
              </form>
              <?php
                if($_SERVER["REQUEST_METHOD"]=="POST") {
                  if(isset($_POST["logout_btn"])) {
                    session_unset();
                    session_destroy();
                    header("Location: index.php");
                    exit();
                  }
                }
              ?>
            </div>
          </div>
        </div>
    </div>

    <div class="about_sidebar">
      <div class="row">
        <div class="col-md-2">
          <ul>
            <li>
              <i style="color:orange;" class="fas fa-info-circle"></i><a href="#!/">&emsp;Basic Info</a>
            </li>
            <li>
              <i style="color:black;" class="fas fa-briefcase"></i><a href="#!education_work">&emsp;Education and Work</a>
            </li>
            <li>
              <i style="color:red;" class="fas fa-heart"></i><a href="#!my_interests">&emsp;My Interests</a>
            </li>
            <li>
              <i style="color:blue;" class="fas fa-sliders-h"></i><a href="#!account_settings">&emsp;Account Settings</a>
            </li>
            <li>
              <i style="color:green;" class="fas fa-lock"></i><a href="#!change_password">&emsp;Change Password</a>
            </li>
          </ul>
        </div>
        <div class="col-md-10">
          <div ng-view></div>
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
    <script src="js/angular.min.js"></script>
    <script src="js/angular-route.min.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>
