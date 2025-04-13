<?php require "../layouts/header.php"; ?>  
<?php require "../../config/config.php"; ?>  
<?php 

  if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }


  if(isset($_POST['submit'])) {

    if(empty($_POST['name'])) {
      echo "<script>alert('some inputs are empty');</script>";
    } else {


      $name = $_POST['name'];
      $final_name = str_replace(' ', '-', trim($name)); 

      $insert = $conn->prepare("INSERT INTO categories (name) VALUES
      (:name)");

      $insert->execute([
        ':name' => $final_name,
       
      ]);

      echo "<script>window.location.href='".ADMINURL."/categories-admins/show-categories.php' </script>";

    }
  }


?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Create Categories</h5>
              <form method="POST" action="create-category.php">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">create</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>  
