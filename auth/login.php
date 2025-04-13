<?php require "../includes/header.php"; ?>
<?php require "../config/config.php"; ?>
<?php 

  if(isset($_SESSION['username'])) {
    echo "<script>window.location.href='".APPURL."' </script>";

  }
if(isset($_POST['submit'])) {

  if(empty($_POST['email']) OR empty($_POST['password'])) {
    echo "<script>alert('some inputs are empty');</script>";
  } else {


    $email = $_POST['email'];
    $password = $_POST['password'];

    //query
    $login = $conn->query("SELECT * FROM users WHERE email='$email'");
    $login->execute();

    //fetch
    $fetch = $login->fetch(PDO::FETCH_ASSOC);

    if($login->rowCount() > 0) {
      // echo $login->rowCount();
      // echo "email is valid";

      if(password_verify($password, $fetch['mypassword'])) {

        $_SESSION['username'] = $fetch['username'];
        $_SESSION['email'] = $fetch['email'];
        $_SESSION['user_id'] = $fetch['id'];


        echo "<script>window.location.href='".APPURL."' </script>";

      } else {
        echo "<script>alert('email or password is wrong');</script>";

      }

    } else {
      echo "<script>alert('email or password is wrong');</script>";

    }


  }
}


?>
  
  
  <div class="site-wrap">

   
    

    <div class="site-blocks-cover inner-page-cover overlay" style="background-image: url(<?php echo APPURL; ?>/images/hero_bg_2.jpg);" data-aos="fade" data-stellar-background-ratio="0.5">
      <div class="container">
        <div class="row align-items-center justify-content-center text-center">
          <div class="col-md-10">
            <h1 class="mb-2">Log In</h1>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-12" data-aos="fade-up" data-aos-delay="100">
            <h3 class="h4 text-black widget-title mb-3">Login</h3>
            <form action="login.php" method="POST" class="form-contact-agent">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control">
            </div>
            <div class="form-group">
                <input type="submit" name="submit" id="phone" class="btn btn-primary" value="Login">
            </div>
            </form>
          </div>
         
        </div>
      </div>
<?php require "../includes/footer.php"; ?>
