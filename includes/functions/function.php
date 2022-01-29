<?php
require_once "init.php";


/*
==========================
  insert new user
==========================
*/

function insert_admin($name,$email,$password,$reg_state){
    global $con;
    $stmt = $con->prepare("INSERT INTO admins(username,email,password,role) Value(:username,:email,:password,:reg_state)");
    $stmt->execute(
    array(
        ":username"     => $name,
        ":email"    => $email,
        ":password" => $password,
        ":reg_state" => $reg_state,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Admin  added .')
    </script>";
    header("Refresh:3;url=all_admins.php"); 
}
/*
   ==========================  
        insert event 
   ==========================
*/



/*
==========================
  get all data with id
==========================
*/

function get_last_patient(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM patients ORDER BY id DESC LIMIT 1");
    $stmt->execute();
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}

function addPatient($patient_name,$birthday, $result, $nationality, $nation_id, $passport_num,$mrn,$visit_code,$gender,$reg_date,$repo_date,$img,$admin){
    global $con;
    $stmt=$con->prepare("INSERT INTO patients(patient_name,birthday,result,nationality,nation_id,passport_num,mrn,visit_code,gender,reg_date,repo_date,img,admin_id,time)
     VALUES (:patient_name,:birthday, :result,:nationality,:nation_id,:passport_num,:mrn,:visit_code,:gender,:reg_date,:repo_date,:img,:admin_id,:_time)" );
     date_default_timezone_set('Africa/Cairo');
     $_time = date("Y/m/d . H:i:s");
    $stmt->execute(array(
        ":patient_name"         =>$patient_name,
        ":birthday"             =>$birthday,
        ":result"               =>$result,
        ":nationality"          =>$nationality,
        ":nation_id"            =>$nation_id,
        ":passport_num"         =>$passport_num,
        ":mrn"                  =>$mrn,
        ":visit_code"           =>$visit_code,
        ":gender"               =>$gender,
        ":reg_date"             =>$reg_date,
        ":repo_date"            =>$repo_date,
        ":img"                  =>$img,
        ":admin_id"             =>$admin,
        ":_time"                =>$_time,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Added to Patients .')
    </script>";
    header("Refresh:3;url=all_patients.php"); 
}


  /*
   ==========================  
        update_member
   ==========================
*/
function update_patient($patient_name,$birthday, $result, $nationality, $nation_id, $passport_num,$MRN,$visit_code,$gender,$reg_date,$repo_date,$avatar,$admin,$id){
    global $con;
   $stmt= $con->prepare ("UPDATE patients SET patient_name=?,birthday=?,result=?,nationality=?,nation_id=?,passport_num=?,mrn=?, visit_code=?,gender=?,reg_date=?,repo_date=?,img=?,admin_id=? WHERE id=?");
   $stmt ->execute(array($patient_name, $birthday,$result,$nationality,$nation_id,$passport_num,$MRN,$visit_code, $gender,$reg_date, $repo_date, $avatar,$admin, $id));
       echo "
       <script>
           toastr.success('Great ,successfully: Patient update .')
       </script>";
       header("Refresh:2;url=all_patients.php"); 
}


/*
==========================
  check if user exist
==========================
*/

function check_user ( $email , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM admins WHERE email = ?");
    $stmt->execute(array($email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( $rows['password'] == $hased ){
            $_SESSION['userid']    = $rows['id'];
            $_SESSION['username']  = $rows['username'];
            $_SESSION['useremail'] = $rows['email'];
            $_SESSION['role'] = $rows['role'];
            echo "
            <script>
                toastr.success('Welcome Back " . $_SESSION['username'] . " .')
            </script>";

                header("Refresh:3;url=admin_dash.php");

        }
        else{
            echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";
        }
    }
    else{
            echo "
            <script>
                toastr.error('Sorry Your Email OR Password is not Correct.')
              </script>";
        }
}
/*
==========================
    get all data
==========================
*/

function getAllData($table){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table");
    $stmt->execute();
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


/*
==========================
  get all data with id
==========================
*/

function getData_with_id($table,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    return $rows;
}


/*
==========================
  get patient with id
==========================
*/

function getPatient_with_admin($table,$id){
    global $con;
    $stmt = $con->prepare("SELECT * FROM $table WHERE admin_id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}


/*
==========================
  count
==========================
*/

function count_data($colume,$databname){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}



/*IMPORTANT !!! SN = 636f6465206279203a20416d722d4d6f68616d65642d4569737361 */

  /*
==========================  
  select_by_id
==========================
*/
function select_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }

/*
   ==========================  
        edit admin 
   ==========================
*/
function editAdmin($name,$email, $hashed, $reg_state,$id){
    global $con;
    $stmt=$con->prepare ("UPDATE admins SET `username`=?,`email`=?, `password`=?,`role`=? WHERE `id`=?");
    $stmt->execute(array($name,$email, $hashed, $reg_state,$id));
    echo "
    <script>
        toastr.success('Great ,successfully: Edited Admin .')
    </script>";
    header("Refresh:3;url=all_admins.php"); 
}


/*
==========================
  count_patients
==========================
*/

function count_patients($id){
    global $con;
    $stmt = $con->prepare("SELECT * From patients Where admin_id = ?");
    $stmt->execute(array($id));
    $rows = $stmt->fetchAll();
return $rows;
}
