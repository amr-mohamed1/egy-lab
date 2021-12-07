<?php
ob_start();
session_start();
$boot="no";
$script="login.js";
include 'init.php';
if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["email"]) && !empty($_POST["password"]) )
{
    $email = filter_var($_POST["email"] , FILTER_SANITIZE_EMAIL);
    $password = filter_var($_POST["password"] , FILTER_SANITIZE_STRING);
    $hased = sha1($password);
    check_user($email,$hased);
}

?>


<div class="container"> 
    <img style="display: block;margin:auto;width:250px" src="img/succ1.gif" alt="admin">
    <h3 class="text-center mt-5 mb-5">Welcome To Website Dashboard</h3>
    <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>">
        <div class="form-row">
            <div class="form-group col-md-12">
                <label>Email</label>
                <input style="direction: ltr;" placeholder="Please Enter Your Email" name="email" autocomplete="off" type="email" class="form-control">
            </div>
            <div class="form-group col-md-12">
                <label>Password</label>
                <input style="direction: ltr;" name="password" placeholder="Please Enter Your Password" type="password" class="form-control">
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Sign in</button>
    </form>
</div>

<?php 

require_once "./includes/template/footer.php";
ob_end_flush();
