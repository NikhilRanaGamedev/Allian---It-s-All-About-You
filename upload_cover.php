<?php
ob_start();
include "connect.php";
$target_dir = "users/".$_SESSION['username']."\profile_pics/";
$target_file = $target_dir . basename($_FILES["cover_btn"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
$ext = pathinfo($filename, PATHINFO_EXTENSION);
$user_id = $_SESSION["user_id"];
$username = $_SESSION["username"];
$pic_path = "users/$username/profile_pics/cover.jpg";

if($_SERVER["REQUEST_METHOD"]=="POST") {
  if(isset($_POST["btn_upload_cover"])) {
    $check = getimagesize($_FILES["cover_btn"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
        echo "<script>alert('File is not an image.')</script>";
        $uploadOk = 0;
    }
    // Check if file already exists
    if (file_exists($target_file)) {
      echo "<script>alert('Sorry, file already exists.')</script>";
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["cover_btn"]["size"] > 10000000) {
      echo "<script>alert('Sorry, your file is too large.')</script>";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
      echo "<script>alert('Sorry, only JPG, JPEG, PNG & GIF files are allowed.')</script>";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "<script>alert('Sorry, your file was not uploaded.')</script>";
      // if everything is ok, try to upload file
    } else {
      if (move_uploaded_file($_FILES["cover_btn"]["tmp_name"], "users/".$_SESSION['username']."\profile_pics/cover.jpg")) {
       echo "<script>alert('The file ". basename( $_FILES["cover_btn"]["name"]). " has been uploaded.')</script>";
       $value = mysqli_query($conn, "UPDATE `user_info` SET `profile_cover` = '$pic_path' where user_id = $user_id");
       header("Location: about.php#!/"); /* Redirect browser */
       header("Cache-Control: no-cache, no-store, must-revalidate"); // HTTP 1.1.
       header("Pragma: no-cache"); // HTTP 1.0.
       header("Expires: 0"); // Proxies.
       ob_end_flush();
       exit();
        } else {
            echo "<script>alert('Sorry, there was an error uploading your file.')</script>";
        }
    }
  }
}
?>
