<?php
session_start();
ob_start(); 
$style="addMember.css";
include 'init.php';
if(isset($_SESSION['role'])){
require './layout/topNav.php';
$last = get_last_patient();
     if($_SERVER['REQUEST_METHOD'] =='POST'){


        if(empty($_POST["name"]) || empty($_POST["result"])){
            echo "
            <script>
                toastr.error('Sorry Name or Result Can not be empty......!')
            </script>";
          }
          elseif(empty($_POST["nation"]) || empty($_POST["nation_id"]) || empty($_POST["passport_num"])){
            echo "
            <script>
                toastr.error('Sorry nation or National Num or Passport Num Can not be empty......!')
            </script>";
          }
          elseif(empty($_POST["MRN"]) || empty($_POST["visit_code"])){
            echo "
            <script>
                toastr.error('Sorry MRN or Visit Code Can not be empty......!')
            </script>";
          }
          else if(!is_string($_POST["name"]) || !is_string($_POST["result"])  || !is_string($_POST["nation"])){
            echo "
            <script>
                toastr.error('Sorry name or result or nation Should be string only......!')
            </script>";
          }
          else if(!is_numeric($_POST["nation_id"])){
            echo "
            <script>
                toastr.error('Sorry nation_id Should be Numeric only......!')
            </script>";
          }
          else if(!is_numeric($_POST["MRN"]) || !is_numeric($_POST["visit_code"])){
            echo "
            <script>
                toastr.error('Sorry MRN or Visit Code Should be Numeric only......!')
            </script>";
          }
          else if( strlen((string)$_POST["MRN"])<4){
            echo "
            <script>
                toastr.error('Sorry MRN Should be more than 3 Number......!')
            </script>";
          }
          else if( strlen((string)$_POST["visit_code"])<4){
            echo "
            <script>
                toastr.error('Sorry Visit Code Should be more than 4 Number......!')
            </script>";
          }
          else if( strlen((string)$_POST["nation_id"])<14){
            echo "
            <script>
                toastr.error('Sorry nation_id Should be more than 14 Number......!')
            </script>";
          }
          else{
            $patient_name           =FILTER_VAR($_POST['name'],FILTER_SANITIZE_STRING);
            $birthday               =$_POST['birth_day'];
            $result                 =FILTER_VAR($_POST['result'],FILTER_SANITIZE_STRING);
            $nation                 =FILTER_VAR($_POST['nation'],FILTER_SANITIZE_STRING);
            $nation_id              =FILTER_VAR($_POST['nation_id'],FILTER_SANITIZE_NUMBER_INT);
            $passport_num           =$_POST['passport_num'];
            $MRN                    =$_POST['MRN'];
            $visit_code             =$_POST['visit_code'];
            $gender                 =FILTER_VAR($_POST['gender'],FILTER_SANITIZE_STRING);
            $reg_date               =$_POST['reg_date'];
            $repo_date              =$_POST['repo_date'];
            $admin                  = $_SESSION['userid'];





            $avatar_name            = $_FILES["user_img"]["name"];
            $size                   = $_FILES["user_img"]["size"];
            $tmp_name               = $_FILES["user_img"]["tmp_name"];
            $type                   = $_FILES["user_img"]["type"];
            $ext_allowed            = array("png","jpg","jpeg","");
            @$extention             = strtolower(end(explode(".",$avatar_name)));

            if(in_array($extention,$ext_allowed)){
                $avatar = "patient" . "_" . rand(0,100000) . "." . $extention ;
                
                $destination = "img/Patients/" . $avatar ;
        
                
                /*check if info already added*/
        
                global $con;
                $stmt = $con->prepare("SELECT * FROM patients WHERE patient_name = ?");
                $stmt->execute(array($patient_name));
                $rows = $stmt->fetch(PDO::FETCH_ASSOC);
                $count = $stmt->rowCount();
                if ($count){
                    echo "
                        <script>
                            toastr.error('Sorry This Patient Name is already excit.')
                        </script>";
                }
                else{



                addPatient($patient_name,$birthday, $result, $nation, $nation_id, $passport_num,$MRN,$visit_code,$gender,$reg_date,$repo_date,$avatar,$admin);
                move_uploaded_file($tmp_name,$destination);



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
    <div id="layoutSidenav_content">
    <div class="container mainAddForm">
        <img class="addMemberMainImg mt-5" src="img/add_event.png" >
        <p class="firstParagraph text-center">Welcome to Patients page </p>
        <p class="secondParagraph text-center mb-5 pb-5">From this page you can add new Patient</p>
        <form method="POST" action="<?php $_SERVER['PHP_SELF'] ?>" enctype="multipart/form-data">
            <!--Name-->
            <div class="row">

                <div class=" col-md-6 mb-3">
                    <label for="Name">Patient Name</label>
                    <input type="text" class="form-control"  id="Name " required
                        placeholder="Enter Event name"  autocomplete="off" name="name">
                </div>
             
                <!--Date Of Birth-->
                <div class=" col-md-6 mb-3">
                    <label for="passport_num">Date Of Birth</label>
                    <input type="date" class="form-control"  id="birth_day " 
                        placeholder="Enter Date Of Birth" required autocomplete="off"
                        name="birth_day">
                </div>  

              <!--result  -->

                <div class=" col-md-6 mb-3">
                <label for="season">Test Result</label>
                <select class="form-control  ui search dropdown" id="season" name="result">
                      <option selected disabled value="">Choose...</option>
                      <option value="Negative">Negative</option>
                      <option value="Positive">Positive</option>
                </select>
                </div>

            <!--Nationality-->
            <div class="col-md-6 mb-3">
                    <label for="nation">Nationality</label>
                    <input type="text" class="form-control"  id="nation " required
                        placeholder="Enter Nationality "  autocomplete="off" name="nation">
                </div>
                        
                <!--National id-->
                <div class=" col-md-6 mb-3">
                    <label for="nation_id">National Num</label>
                    <input type="number" class="form-control"  id="nation_id " 
                        placeholder="Enter National Num" required autocomplete="off"
                        name="nation_id">
                </div>  
                                                        
                <!--Passport Num-->
                <div class=" col-md-6 mb-3">
                    <label for="passport_num">Passport Num </label>
                    <input type="text" class="form-control"  id="passport_num " 
                        placeholder="Enter Passport Num " required  autocomplete="off"
                        name="passport_num">
                </div>  
                        
                <!--National id-->
                <div class=" col-md-6 mb-3">
                    <label for="MRN">MRN</label>
                    <div class="input-group mb-2">
                    <div style="width: 100%;" class="input-group-prepend">
                      <div class="input-group-text">N115</div>
                      <input type="number" class="form-control" value="<?php echo $last["mrn"]+1;?>" id="MRN" 
                          placeholder="Enter MRN" required  max="9999" autocomplete="off"
                          name="MRN">
                    </div>
                    </div>
                </div> 
                                        
                <!--National id-->
                <div class=" col-md-6 mb-3">
                    <label for="Visit Code">Visit Code</label>
                    <div class="input-group mb-2">
                    <div style="width: 100%;" class="input-group-prepend">
                      <div class="input-group-text">N2021102405</div>
                      <input type="number" class="form-control" value="<?php echo $last["visit_code"]+1;?>" id="Visit Code" 
                          placeholder="Enter Visit Code" max="9999" required autocomplete="off"
                          name="visit_code">
                    </div>
                    </div>
                </div> 

                            
              <!--Gender  -->

              <div class="col-md-6 mb-3">
                <label for="Gender">Gender</label>
                <select class="form-control  ui search dropdown" id="Gender" name="gender">
                      <option selected disabled value="">Choose...</option>
                      <option value="Male">Male</option>
                      <option value="Female">Female</option>
                </select>
                </div>



                                        
                <!--Registration Date-->
                <div class=" col-md-6 mb-3">
                    <label for="passport_num">Registration Date</label>
                    <input type="datetime-local" class="form-control"  id="reg_date " 
                        placeholder="Enter Registration Date" required autocomplete="off"
                        name="reg_date">
                </div>  
               
                <!--Reporting Date-->
                <div class=" col-md-6 mb-3">
                    <label for="passport_num">Reporting Date</label>
                    <input type="datetime-local" class="form-control"  id="repo_date " 
                        placeholder="Enter Reporting Date" required  autocomplete="off"
                        name="repo_date">
                </div>  
                
                <!--img-->
                <div class=" col-md-6 mb-3 ">
                    <label for="img">img</label>
                    <input type="file" class="form-control" id="img" name="user_img" required >
                </div>
              <button name="submit" class="btn btn-primary m-3 ">Add Patient </button>

                        </div>
                        </div>
            </form>
            </div>
        </div>

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:siggin.php");
}
ob_end_flush();
?>
