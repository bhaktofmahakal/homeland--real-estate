<?php require "../layouts/header.php"; ?>  
<?php require "../../config/config.php"; ?>  
<?php 

  if(!isset($_SESSION['adminname'])) {
    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
  }


  if(isset($_GET['id'])) {
    $id = $_GET['id'];

    $category = $conn->query("SELECT * FROM categories WHERE id='$id'");

    $category->execute();
  
    $allCategory= $category->fetch(PDO::FETCH_OBJ);
  }


  if(isset($_POST['submit'])) {

    if(empty($_POST['name'])) {
      echo "<script>alert('input is empty');</script>";
    } else {


      $name = $_POST['name'];
     
      $update = $conn->prepare("UPDATE categories SET name = '$name' WHERE id = '$id'");
      $update->execute();

    

      echo "<script>window.location.href='".ADMINURL."/categories-admins/show-categories.php' </script>";

    }
  }


?>
       <div class="row">
        <div class="col">
          <div class="card">
            <div class="card-body">
              <h5 class="card-title mb-5 d-inline">Update Categories</h5>
              <form method="POST" action="update-category.php?id=<?php echo $allCategory->id; ?>">
                <!-- Email input -->
                <div class="form-outline mb-4 mt-4">
                  <input type="text" name="name" id="form2Example1" value="<?php echo $allCategory->name; ?>" class="form-control" placeholder="name" />
                 
                </div>

      
                <!-- Submit button -->
                <button type="submit" name="submit" class="btn btn-primary  mb-4 text-center">update</button>

          
              </form>

            </div>
          </div>
        </div>
      </div>
<?php require "../layouts/footer.php"; ?>  
