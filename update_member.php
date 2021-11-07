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
      $thisuser = select_member_by_id('members',$id);
    #$thisuser =getData_with_id('members',$id);
   /*filter_inputs*/
   if ($_SERVER['REQUEST_METHOD']== 'POST'){
        $user_name      = FILTER_VAR( $_POST['name'], FILTER_SANITIZE_STRING);
        $season         = FILTER_VAR( $_POST['season'], FILTER_SANITIZE_STRING);
        $email          = FILTER_VAR( $_POST['email'], FILTER_SANITIZE_EMAIL);
        $birthday       = FILTER_VAR( $_POST['birthday'], FILTER_SANITIZE_STRING);
        $phone          = FILTER_VAR( $_POST['phone'], FILTER_SANITIZE_NUMBER_INT);
        $commity        = FILTER_VAR( $_POST['commity'], FILTER_SANITIZE_STRING);
        $college_name   = FILTER_VAR( $_POST['college-name'], FILTER_SANITIZE_STRING);
        $college_year   = FILTER_VAR( $_POST['college-year'], FILTER_SANITIZE_NUMBER_INT);
        $facebook       = FILTER_VAR( $_POST['facebook'], FILTER_SANITIZE_URL);
        $linkedIn       = FILTER_VAR( $_POST['linkedIn'], FILTER_SANITIZE_URL);
        $old_member      = FILTER_VAR( $_POST['old-member'], FILTER_SANITIZE_NUMBER_INT);
        $about          = FILTER_VAR( $_POST['about'], FILTER_SANITIZE_STRING);
        $avatar_name            = $_FILES["img"]["name"];
        $size                   = $_FILES["img"]["size"];
        $tmp_name               = $_FILES["img"]["tmp_name"];
        $type                   = $_FILES["img"]["type"];
        $ext_allowed            = array("png","jpg","jpeg","");
        @$extention             = strtolower(end(explode(".",$avatar_name)));
        if(in_array($extention,$ext_allowed)){
            $avatar = rand(0,1000000) . "_" . $avatar_name ;
            $destination = "img/ieee-members/" . $avatar ;
    
            

              if(!empty($avatar_name)){
                        update_member($user_name, $email,$birthday, $phone,$commity, $season,$college_name,  $college_year,$about, $avatar,$old_member, $facebook, $linkedIn, $id);   
                @unlink("img/ieee-members/" . $thisuser["img"]);
                move_uploaded_file($tmp_name,$destination);
              }else{
                $avatar=$event['img'];
                        update_member($user_name, $email,$birthday, $phone,$commity, $season,$college_name,  $college_year,$about, $avatar,$old_member, $facebook, $linkedIn, $id);
              }


    
            
        }else{
          echo "
          <script>
              toastr.error('Sorry This Extention not excit.')
          </script>";
        }  

      }

    } 
    


 ?>
 
<div id="layoutSidenav">

           
<?php 
   require './layout/sidNav.php';
?> 
</div>
 <div class="container mainAddForm">
        <img class="addMemberMainImg" src="img/addMember.png">
        <p class="firstParagraph text-center">Welcome to website dashboard</p>
        <p class="secondParagraph text-center">From this page you can update members</p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
           
            <div class="row m-3">
              <!--User Name-->
                <div class="col-md-6 col-xs-12">
                    <label for="Name">User Name</label>
                    <input type="text" class="form-control"  id="Name " 
                        placeholder="Enter User name" name="name" autocomplete="off" 
                        value="<?php echo $thisuser['name'];?>">
                </div>
                <!--Birthday-->  
                <div class="col-md-6 col-xs-12">
                    <label for="Birthday">Birthday</label>
                    <input type="date" class="form-control" id="Birthday" name="birthday"
                    value="<?php echo $thisuser['birthday'];?>">
                </div>
              </div>

              <div class="row m-3">
                <!--Email-->           
                <div class="col-md-6 col-xs-12">
                    <label for="Email">Email</label>
                    <input type="email" class="form-control" id="Email"
                            placeholder="Enter Email" name="email" 
                            value="<?php echo $thisuser['email'];?>">
                </div>
                <!--Phone-->
                <div class="col-md-6 col-xs-12">
                    <label for="Phone">Phone</label>
                    <input type="tel" class="form-control" id="Phone"
                    placeholder="Enter phone" name="phone" autocomplete="off"
                    value="<?php echo $thisuser['phone'];?>">
                </div>
              </div>
              
              <div class="row m-3">
                <!--college name--->
                <div class="col-md-6 col-xs-12">
                    <label for="college">college name</label>
                    <input type="text" class="form-control" id="college"
                    placeholder="Enter college name " name ="college-name" autocomplete="off"
                    value="<?php echo $thisuser['college-name'];?>">
                </div>
                <!--college Year-->
                <div class="col-md-6 col-xs-12">
                    <label for="collegeYear">college Year</label>
                    <select class="form-control custom-select ui search dropdown"  id="collegeYear"
                    placeholder="Enter college Year " name ="college-year"
                   >
                        <option style="display: none;"><?php echo $thisuser['college-year'];?></option>
                        <option  value="1">1</option>
                        <option  value="2">2</option>
                        <option  value="3">3</option>
                        <option  value="4">4</option>
                        <option  value="5">5</option>
                      </select>
                </div>
              </div>

              <div class="row m-3">
                <!---Facebook-->
                <div class="col-md-6 col-xs-12">
                    <label for="Facebook">Facebook</label>
                    <input type="text" class="form-control" id="Facebook"
                    placeholder="Enter Facebook " name ="facebook"
                    value="<?php echo $thisuser['facebook'];?>">
                </div>
                <!--linked In-->
                <div class="col-md-6 col-xs-12">
                    <label for="linkedIn">linked In</label>
                    <input type="text" class="form-control" id="linkedIn"
                    placeholder="Enter linkedIn " name ="linkedIn"
                    value="<?php echo $thisuser['linkedIn'];?>">
                </div>
              </div>

              <div class="row m-3">
                <!--old Board--->
                <div class="col-md-6 col-xs-12">
                    <label for="OldMember">Old Member</label>
                    <select id="OldMember" class="form-control"  name="old-member"
                    >
                    <option style="display: none;"><?php
                      if($thisuser['old-member']==1){
                        echo "<td>". "Yes"	."</td>";}
                      elseif ($thisuser['old-member']==0) {
                        echo "<td>". "No"	."</td>";}?></option>
                        <option  value="1">Yes</option>
                        <option  value ="0">No</option>
                    </select>
                </div>
                <div class="col-md-6 col-xs-12">
                    <label for="Season">Season</label>
                    <select class="custom-select ui search dropdown" name="season" id="season" required>
                      <option selected disabled value=""><?php echo $thisuser['season'];?></option>
                      <?php for($i=1 ; $i<=date('Y')-2009 ; $i++){?>
                      <option value="<?php echo (2009 + $i - 1) . " / " . (2009 + $i)?>"><?php echo (2009 + $i - 1) . " / " . (2009 + $i)?></option>
                      <?php } ?>
                  </select>
                </div>
              </div>
              
              <div class="row m-3">
                <!--Commity-->
                <div class="col-md-6 col-xs-12">
                    <label for="Commity">Commity</label>
                    <select class="form-control custom-select ui search dropdown"  id="Commity"name="commity">
                    <option style="display: none;"><?php echo $thisuser['commity'];?></option>
                        <option  value="PR">PR</option>
                        <option  value="FR">FR</option>
                        <option  value="HR">HR</option>
                        <option value="Logistics">Logistics</option>
                        <option value="scientific">scientific</option>
                      </select>
                </div>
                <!--Photo-->
                <div class="col-md-6 col-xs-12">
                    <label for="HosterPhoto">Member photo</label>
                    <input type="file" class="form-control-file" id="HosterPhoto" name="img"
                    value="<?php echo $thisuser['img'];?>">               
                 </div>

            </div>

            <div class="row m-3">
                <!--about-->
                <div class="col-lg-12">
                  <label for="aboutMember">About Member</label>
                  <textarea id="aboutMember" name="about" placeholder="about Member:" rows="4" autocomplete="off" class="form-control"
                > <?php echo $thisuser['about'];?> </textarea>
                 


              </div>
            </div>
                     
              <!--btn -> add--->
                <button class="btn btn-primary mt-3 ml-4">Update into board </button>
               </div>
            </form>
        </div>



<?php
require_once "./includes/template/footer.php";
 ob_end_flush();?>