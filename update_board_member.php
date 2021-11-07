<?php
session_start();
ob_start(); 
$style="addMember.css";
include 'init.php';

// incase of exist session
// if(isset($_SESSION['username'])){

/*check member id*/ 

if (isset($_GET['id']) && is_numeric($_GET['id'])/*&&check_user ( 'email' , 'password')*/) {
    $id=($_GET['id']);
    //select this member
      $boardMember = select_by_id('board',$id);
    #$thisuser =getData_with_id('members',$id);
   /*filter_inputs*/
   if ($_SERVER['REQUEST_METHOD']== 'POST'){
        $name           = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
        $season         = FILTER_VAR( $_POST['season'], FILTER_SANITIZE_STRING);
        $email          = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
        $password       = sha1      ($_POST['password']);
        $birthday       = FILTER_VAR( $_POST['birthday'], FILTER_SANITIZE_STRING);
        $phone          = FILTER_VAR( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $position       = FILTER_VAR( $_POST['position'], FILTER_SANITIZE_STRING);
        $commity        = FILTER_VAR( $_POST['commity'], FILTER_SANITIZE_STRING);
        $college_name   = FILTER_VAR( $_POST['college-name'], FILTER_SANITIZE_STRING);
        $college_year   = FILTER_VAR( $_POST['college-year'], FILTER_SANITIZE_NUMBER_INT);
        $facebook       = FILTER_VAR( $_POST['facebook'], FILTER_SANITIZE_URL);
        $linkedIn       = FILTER_VAR( $_POST['linkedIn'], FILTER_SANITIZE_URL);
        $old_member      = FILTER_VAR( $_POST['old_member'], FILTER_SANITIZE_STRING);
        $about          = FILTER_VAR( $_POST['about'], FILTER_SANITIZE_STRING);
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

              if(!empty($avatar_name)){
                update_board_member($name, $email,$password,$birthday, $phone, $position,$commity, $season,$college_name,  $college_year,$about, $avatar,$old_member, $facebook, $linkedIn, $id);  
                unlink("img/ieee-board/" . $boardMember["img"]);
                move_uploaded_file($tmp_name,$destination);
              }else{
                $avatar="0";
                update_board_member($name, $email,$password,$birthday, $phone, $position,$commity, $season,$college_name,  $college_year,$about, $avatar,$old_member, $facebook, $linkedIn, $id);
              }

    
            
        }else{
          echo "
          <script>
              toastr.error('Sorry This extention not excit.')
          </script>";
        }    




    } 
    }
//     else{
//         echo "<h3 class='alert alert-danger'>you can not reach this page</h3>";
        
//         header("Refresh:3;url=index.html"); 
               
//     }
// }else{ echo "<div class='alert alert-danger'>you can not see this page id not exist</div>";
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
        <img class="addMemberMainImg" src="img/addMember.png">
        <p class="firstParagraph text-center">Welcome to website dashboard</p>
        <p class="secondParagraph text-center">From this page you can Update board member </p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
           
            <div class="row  m-2">
              <!--User Name-->
                <div class="col-md-6 col-xs-12">
                    <label for="Name">Name</label>
                    <input type="text" class="form-control"  id="Name " 
                       placeholder="Enter User name"  name="name" autocomplete="off" 
                        value="<?php echo $boardMember['name'];?>">
                </div>
              <!--Season-->
                <div class="col-md-6 col-xs-12">
                    <label for="Season">Season</label>
                    <select class="custom-select ui search dropdown" name="season" id="season" required>
                      <option selected disabled value=""><?php echo $boardMember['season'];?></option>
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
                            placeholder="Enter Email" name="email" 
                            value="<?php echo $boardMember['email'];?>">
                </div><!--autocomplete="new-off"-->
                <!--password--->
                <div class="col-md-6 col-xs-12">
                    <label for="Password">Password</label>
                    <input required type="password" class="form-control" id="Password"
                    placeholder="Enter email password" name="password" autocomplete="new-password"
                    value="<?php #echo $boardMember['paasword'];?>">
                </div>
              </div>
              <div class="row  m-2">
                <!--Birthday-->  
                <div class="col-md-6 col-xs-12">
                    <label for="Birthday">Birthday</label>
                    <input type="date" class="form-control" id="Birthday" name="birthday"
                    value="<?php echo $boardMember['birthday'];?>">
                </div>
                <!--phone--->
                <div class="col-md-6 col-xs-12">
                    <label for="Phone">Phone</label>
                    <input type="tel" class="form-control" id="Phone"
                    placeholder="Enter phone" name="phone" autocomplete="off"
                    value="<?php echo $boardMember['phone'];?>">
                </div>
              </div>
              <div class="row  m-2">
                <!--position--->
                <div class="col-md-6 col-xs-12">
                    <label for="Position">Position</label>
                    <input type="text" class="form-control" id="Position"
                    placeholder="Enter Position " name ="position" autocomplete="off"
                    value="<?php echo $boardMember['position'];?>">
                </div>
                <!--Commity-->
                <div class="col-md-6 col-xs-12">
                    <label for="Commity">Commity</label>
                    <select class="form-control custom-select ui search dropdown"  id="Commity"name="commity">
                    <option style="display: none;"><?php echo $boardMember['commity'];?></option>
                        <option  value="PR">PR</option>
                        <option  value="FR">FR</option>
                        <option  value="HR">HR</option>
                        <option value="Logistics">Logistics</option>
                        <option value="scientific">scientific</option>
                      </select>
                </div>
              </div><!--<div class="row  m-2"></div>-->
              
              <div class="row  m-2">
                <!--college name--->
                <div class="col-md-6 col-xs-12">
                    <label for="college">college name</label>
                    <input type="text" class="form-control" id="college"
                    placeholder="Enter college name " name ="college-name" autocomplete="off"
                    value="<?php echo $boardMember['college_name'];?>">
                </div>
                <!--college Year-->
                <div class="col-md-6 col-xs-12">
                    <label for="collegeYear">college Year</label>
                    <select class="form-control custom-select ui search dropdown"  id="collegeYear"
                    placeholder="Enter college Year " name ="college-year"
                   >
                        <option style="display: none;"><?php echo $boardMember['college_year'];?></option>
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
                    placeholder="Enter Facebook " name ="facebook"
                    value="<?php echo $boardMember['facebook'];?>">
                </div>
                <!--linked In-->
                <div class="col-md-6 col-xs-12">
                    <label for="linkedIn">linked In</label>
                    <input type="text" class="form-control" id="linkedIn"
                    placeholder="Enter linkedIn " name ="linkedIn"
                    value="<?php echo $boardMember['linkedIn'];?>">
                </div>
              </div>
              <div class="row  m-2">
                <!--old Board--->
                <div class="col-md-6 col-xs-12">
                    <label for="OldBoard">Old Board</label>
                    <select class="form-control custom-select ui search dropdown"  id="oldBoard"name="old_member"
                    >
                    <option style="display: none;"><?php  
                  if($boardMember['old_member']==1){
                      echo "<td>". "Yes"	."</td>";}
                    elseif ($boardMember['old_member']==0) {
                      echo "<td>". "No"	."</td>";}
                                               
                        ?></option>
                        <option  value="1">Yes</option>
                        <option  value ="0">No</option>
                    </select>
                </div>
                <!--img--->
                <div class="col-md-6 col-xs-12">
                    <label for="HosterPhoto">Hoster photo</label>
                    <input type="file" class="form-control-file" id="HosterPhoto" name="img"
                    value="<?php echo $boardMember['img'];?>">               
                 </div>
              </div>
              <!--about-->
              <div class="row  m-2">
              <div class="col-md-12 col-xs-12">
                  <textarea name="about" placeholder="about you" class="form-control"
                   style="resize:none"
                   
                > <?php echo $boardMember['about'];?> </textarea>
              </div>
            </div>
              <!--btn -> add--->
                <button class="btn btn-primary mt-3 ml-4">Update into board </button>
            </form>
        </div>



<?php
require_once "./includes/template/footer.php";
 ob_end_flush();?>