<?php
$target_dir = "users/".$username."\posts_pics/";
$target_file = $target_dir . basename($_FILES["post_image"]["name"]);
$uploadOk = 1;
$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

// image is empty (and not an error)
if($_FILES['post_image']['name'] == "")
{
  goto leave;
} else {
  // Check if image file is a actual image or fake image
  $check = getimagesize($_FILES["post_image"]["tmp_name"]);
  if($check !== false) {
    $uploadOk = 1;
  } else {
      $_SESSION["err_broken"] = 1;
      $uploadOk = 0;
  }
  // Check file size
  if ($_FILES["post_image"]["size"] > 10000000) {
    $_SESSION["err_size"] = 1;
    $uploadOk = 0;
  }
  // Allow certain file formats
  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
    $_SESSION["err_type"] = 1;
    $uploadOk = 0;
  }
  // Check if $uploadOk is set to 0 by an error
  if ($uploadOk == 0) {
    $_SESSION["err"] = 1;
    // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["post_image"]["tmp_name"], "users/".$username."\posts_pics/$post_id.jpg")) {
     $_SESSION["upload_success"] = 1;
      } else {
        $_SESSION["err_fail"] = 1;
      }
  }
}
leave:
?>
