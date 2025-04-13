<?php 
   require "../layouts/header.php";
    session_unset();
    session_destroy();

    echo "<script>window.location.href='".ADMINURL."/admins/login-admins.php' </script>";
