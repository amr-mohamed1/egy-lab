<?php
ob_start();
session_start();
$boot="no";
$style = "login.css";
$script="login.js";
include 'init.php';
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["signin_email"]) && !empty($_POST["signin_password"]) )
{
    $email = filter_var($_POST["signin_email"] , FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["signin_password"] , FILTER_SANITIZE_STRING);
    $hased = sha1($password);
    check_user($email,$hased);
}

?>


<div style="position: unset;" class="container">
      <div class="forms-container">
        <div class="signin-signup">
          <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" class="sign-in-form">
            <h2 class="title">Sign in</h2>
            <div class="input-field">
              <i class="fas fa-envelope"></i>
              <input type="email" name="signin_email" placeholder="Email" />
            </div>
            <div class="input-field">
              <i class="fas fa-lock"></i>
              <input type="password" name="signin_password" placeholder="Password" />
            </div>
            <input type="hidden" name="state" value="signin">
            <input type="submit" value="Login" class="btn solid" />
          </form>


          
        </div>
      </div>

      <div class="panels-container">
        <div class="panel left-panel">
          <img src="img/undraw_Social_bio_re_0t9u.svg" class="image" alt="logo" />
        </div>
      </div>
    </div>

<?php 

require_once "./includes/template/footer.php";
ob_end_flush();
