<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 


    if(isset($_POST['submit'])) {

        if(empty($_POST['name']) OR empty($_POST['email']) OR empty($_POST['phone'])) {
            echo "<script>alert('some inputs are empty');</script>";
            echo "<script>window.location.href='".APPURL."' </script>";

          } else {

            $name = $_POST['name'];
            $email = $_POST['email'];
            $phone = $_POST['phone'];
            $prop_id = $_POST['prop_id'];
            $user_id = $_POST['user_id'];
            $author = $_POST['admin_name'];
    
            $insert = $conn->prepare("INSERT INTO requests (name, email, phone, prop_id, user_id, author) VALUES
            (:name, :email, :phone, :prop_id, :user_id, :author)");
    
            $insert->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':prop_id' => $prop_id,
                ':user_id' => $user_id,
                ':author' => $author,
                
            ]);
        
            echo "<script>alert('request sent successfully');</script>";
        
        
            echo "<script>window.location.href='".APPURL."/property-details.php?id=$prop_id' </script>";



          }      
      
    }