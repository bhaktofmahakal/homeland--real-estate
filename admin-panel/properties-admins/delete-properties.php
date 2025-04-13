<?php require "../layouts/header.php"; ?>  
<?php require "../../config/config.php"; ?>  
<?php 

  if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }


  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    //delete image(thumbnail)
    $query = $conn->query("SELECT * FROM props WHERE id='$id'");
    $query->execute();
    $fetch_image = $query->fetch(PDO::FETCH_OBJ);
    unlink("thumbnails/" . $fetch_image->image);

    //deleting prop record
    $delete_prop = $conn->query("DELETE FROM props WHERE id='$id'");
    $delete_prop->execute();


    //deleting related images files from images folder
    $images = $conn->query("SELECT * FROM related_images WHERE prop_id='$id'");
    $images->execute();
    $delete_images = $images->fetchAll(PDO::FETCH_OBJ);

    foreach ($delete_images as $delete_image) {
        unlink("images/" . $delete_image->image);
    }


    //deleting related_images records
    $delete_related_images = $conn->query("DELETE FROM related_images WHERE prop_id='$id'");
    $delete_related_images->execute();
  
    echo "<script>window.location.href='".ADMINURL."/properties-admins/show-properties.php' </script>";

  }


  

?>