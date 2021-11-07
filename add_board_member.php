<?php
session_start();
ob_start(); 
$style="addMember.css";
$script = "members.js";
include 'init.php';
// incase of exist session
// if(isset($_SESSION['username'])){

// incase of send from post and some filed is not empty 
if ($_SERVER['REQUEST_METHOD'] == 'POST' && !empty( $_POST['name'])&& !empty($_POST['email']) ){
        $name                   = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
        $season                 = FILTER_VAR( $_POST['season'], FILTER_SANITIZE_STRING);
        $email                  = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
        $password               = sha1      ( $_POST['password']);
        $birthday               =             $_POST['birthday'];
        $phone                  = FILTER_VAR( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $position               = FILTER_VAR( $_POST['position'], FILTER_SANITIZE_STRING);
        $commity                = FILTER_VAR( $_POST['commity'], FILTER_SANITIZE_STRING);
        $college_name           = FILTER_VAR( $_POST['college-name'], FILTER_SANITIZE_STRING);
        $college_year           = FILTER_VAR( $_POST['college-year'], FILTER_SANITIZE_NUMBER_INT);
        $facebook               = FILTER_VAR( $_POST['facebook'], FILTER_SANITIZE_URL);
        $linkedIn               = FILTER_VAR( $_POST['linkedIn'], FILTER_SANITIZE_URL);
        $old_member             = FILTER_VAR( $_POST['old_member'], FILTER_SANITIZE_STRING);
        $about                  = FILTER_VAR( $_POST['about'], FILTER_SANITIZE_STRING);
        $avatar_name            = $_FILES["img"]["name"];
        $size                   = $_FILES["img"]["size"];
        $tmp_name               = $_FILES["img"]["tmp_name"];
        $type                   = $_FILES["img"]["type"];
        $ext_allowed            = array("png","jpg","jpeg","");
        @$extention             = strtolower(end(explode(".",$avatar_name)));
        if(in_array($extention,$ext_allowed)){
            $avatar = rand(0,1000000) . "_" . $avatar_name ;
            $destination = "img/ieee-board/" . $avatar ;
    
            
            /*check if info already added*/
    
            global $con;
            $stmt = $con->prepare("SELECT * FROM board WHERE email = ?");
            $stmt->execute(array($email));
            $rows = $stmt->fetch(PDO::FETCH_ASSOC);
            $count = $stmt->rowCount();
            if ($count){
                echo "
                    <script>
                        toastr.error('Sorry This Board Member (Email) is already excit.')
                    </script>";
            }
            else{
              if(!empty($avatar_name)){
              insert_board_member($name,$email,$password,$birthday,$phone,$position,
              $commity,$season,$college_name,$college_year,$about,$avatar,$old_member,$facebook,$linkedIn);   
                move_uploaded_file($tmp_name,$destination);
              }else{
                $avatar="0";
                insert_board_member($name,$email,$password,$birthday,$phone,$position,
                $commity,$season,$college_name,$college_year,$about,$avatar,$old_member,$facebook,$linkedIn); 
              }


            }   
    
            
        }else{
          echo "
          <script>
              toastr.error('Sorry This Extention not excit.')
          </script>";
        }    


/*

echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";

        $ERROR_LIST = array();

        if(empty($name) && !is_string($name)){
          $ERROR_LIST[] = "<div class=\"alert alert-danger text-right\" role=\"alert\">
          Pleaese fill the name
        </div>";
        }if(empty($email)){
          $ERROR_LIST[] = "<div class=\"alert alert-danger text-right\" role=\"alert\">
          Pleaese fill the email
        </div>";
        }if(empty($password) && strlen($password) < 6){
          $ERROR_LIST[] = "<div class=\"alert alert-danger text-right\" role=\"alert\">
          Pleaese fill the password
        </div>";
        }if(empty($adress) && strlen($adress) == 10){
          $ERROR_LIST[] = "<div class=\"alert alert-danger text-right\" role=\"alert\">
          Pleaese fill the adress , should be 10 chars
        </div>";
        }if(empty($gender) || $gender == "Choose..."){
          $ERROR_LIST[] = "<div class=\"alert alert-danger text-right\" role=\"alert\">
          Pleaese fill the gender
        </div>";
        }if(empty($linkedin)){
          $ERROR_LIST[] = "<div class=\"alert alert-danger text-right\" role=\"alert\">
          Pleaese fill the linkedin
        </div>";
        }

        if (isset($ERROR_LIST)){
          foreach($ERROR_LIST as $error){
            echo $error . "<br>";
          }
        }

        */



    /*XXXXX_img*/


        /*
            images********
            $avatar_name            = $_FILES["img"]["name"];
            $size                   = $_FILES["img"]["size"];
            $tmp_name               = $_FILES["img"]["tmp_name"];
            $img_type                   = $_FILES["img"]["type"];
            $ext_allowed            = array("png","jpg","jpeg","");
            @$extention             = strtolower(end(explode(".",$avatar_name)));
            if(in_array($extention,$ext_allowed)){
                $avatar = rand(0,1000) . "_" . $avatar_name ;
                $destination = "images/books/" . $avatar ; 
                move_uploaded_file($tmp_name,$destination);
                insert_book($name,$author,$desc,$rate,$avatar);
            */        

    }
    // else{
    //     echo "<div class='alert alert-danger'>you can not add member</div>";
    //     header("refresh:5;url=index.html");
    // }
// }
// else{ echo "<div class='alert alert-danger'>you can not see this page id not exist</div>";
//     header("refresh:5;url=index.html");
//     exit();
// }

?>

<div id="layoutSidenav">

           
 <?php 
    require './layout/sidNav.php';
?> 
</div>
    <div class="container mainAddForm">
        <img class="addMemberMainImg pt-5" src="img/addMember.png">
        <p class="firstParagraph text-center">Welcome to website dashboard</p>
        <p class="secondParagraph text-center pb-5">From this page you can add new hoster to dashboard</p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data" >
           
            <div class="row  m-2">
              <!--User Name-->
                <div class="col-md-6 col-xs-12">
                    <label for="Name">User Name</label>
                    <input type="text" class="form-control"  id="Name " 
                        placeholder="Enter User name" name="name" autocomplete="off">
                </div>
              <!--Season-->
                <div class="col-md-6 col-xs-12">
                    <label for="Season">Season</label>
                    <select class="custom-select ui search dropdown"  name="season" id="season" required>
                      <option selected disabled value="">Choose...</option>
                      <?php for($i=1 ; $i<=date('Y')-2009 ; $i++){?>
                      <option value="<?php echo (2009 + $i - 1) . " / " . (2009 + $i)?>"><?php echo (2009 + $i - 1) . " / " . (2009 + $i)?></option>
                      <?php } ?>
                  </select>
                </div>

              </div>
              <div class="row m-2">
                <!--Email-->           
                <div class="col-md-6 col-xs-12">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email"
                            placeholder="Enter Email" name="email" >
                </div><!--autocomplete="new-off"-->
                <!--password--->
                <div class="col-md-6 col-xs-12">
                    <label for="Password">Password</label>
                    <input type="password" class="form-control" id="Password"
                    placeholder="Enter email password" name="password" autocomplete="new-password">
                </div>
              </div>
              <div class="row  m-2">
                <!--Birthday-->  
                <div class="col-md-6 col-xs-12">
                    <label for="Birthday">Birthday</label>
                    <input type="date" class="form-control" id="Birthday" name="birthday">
                </div>
                <!--phone--->
                <div class="col-md-6 col-xs-12">
                    <label for="Phone">Phone</label>
                    <input type="tel" class="form-control" id="Phone"
                    placeholder="Enter phone" name="phone" autocomplete="off">
                </div>
              </div>
              <div class="row  m-2">
                <!--position--->
                <div class="col-md-6 col-xs-12">
                    <label for="Position">Position</label>
                    <select class="custom-select ui search dropdown"  name="position" id="position" required>
                      <option selected disabled value="">Choose...</option>
                      <option value="Chairman">Chairman</option>
                      <option value="Secretary">Secretary</option>
                      <option value="Treasurer">Treasurer</option>
                      <option value="Vice Technical">Vice Technical</option>
                      <option value="Vice Non-technical">Vice Non-technical</option>
                      <option value="Head">Head</option>
                      <option value="Vice Head">Vice Head</option>
                  </select>
                </div>
                <!--Commity-->
                <div class="col-md-6 col-xs-12">
                    <label for="Commity">Commity</label>
                    <select class="form-control ui search dropdown"  id="Commity"name="commity">
                        <option selected disabled value="">Choose...</option>
                        <option value="PR">PR</option>
                        <option value="FR">FR</option>
                        <option value="HR">HR</option>
                        <option value="Logistics">Logistics</option>
                        <option value="scientific">scientific</option>
                        <option value="Media">Media</option>
                      </select>
                </div>
              </div><!--<div class="row  m-2"></div>-->
              
              <div class="row  m-2">
                <!--college name--->
                <div class="col-md-6 col-xs-12">
                    <label for="college">college name</label>
                    <input type="text" class="form-control" id="college"
                    placeholder="Enter college name " name ="college-name" autocomplete="off">
                </div>
                <!--college Year-->
                <div class="col-md-6 col-xs-12">
                    <label for="collegeYear">college Year</label>
                    <select class="form-control ui search dropdown"  id="collegeYear"
                    placeholder="Enter college Year " name ="college-year">
                        <option selected disabled value="">Choose...</option>
                        <?php
                            for ($i=1; $i <6 ; $i++) { 
                            echo '<option >'.$i.'</option>';
                            }
                        ?>                      
                        </select>
                </div>
              </div>
              <div class="row  m-2">
                <!---Facebook-->
                <div class="col-md-6 col-xs-12">
                    <label for="Facebook">Facebook</label>
                    <input type="text" class="form-control" id="Facebook"
                    placeholder="Enter Facebook " name ="facebook">
                </div>
                <!--linked In-->
                <div class="col-md-6 col-xs-12">
                    <label for="linkedIn">linked In</label>
                    <input type="text" class="form-control" id="linkedIn"
                    placeholder="Enter linkedIn " name ="linkedIn">
                </div>
              </div>
              <div class="row  m-2">
                <!--old Board--->
                <div class="col-md-6 col-xs-12">
                    <label for="OldBoard">Old Board</label>
                    <select class="form-control custom-select ui search dropdown"  id="oldBoard"name="old_member">
                        <option selected disabled value="">Choose...</option>    
                        <option   value="Yes">Yes</option>
                        <option   value ="No">No</option>
                    </select>
                </div>
                <!--img--->
                <div class="col-md-6 col-xs-12">
                    <label>Hoster photo</laber=>
                    <input style="direction: ltr;padding:0" name="img" type="file" class="form-control">            </div>
              </div>
              <!--about-->
              <div class="row  m-2">
              <div class="col-md-12 col-xs-12">
                  <label>About Hoster</label>
                  <textarea name="about" class="form-control" placeholder="Some Info About member *" rows="4" autocomplete="off"></textarea>
              </div>
            </div>
              <!--btn -> add--->
                <button class="btn btn-primary mt-3 ml-4">Add to board </button>
            </form>
        </div>
    <?php
    require_once "./includes/template/footer.php";
    ob_end_flush();?>
