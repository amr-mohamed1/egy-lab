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



function addPatient($patient_name,$birthday, $result, $nationality, $nation_id, $passport_num,$mrn,$visit_code,$gender,$reg_date,$reg_time,$repo_date,$repo_time,$img,$admin){
    global $con;
    $stmt=$con->prepare("INSERT INTO patients(patient_name,birthday,result,nationality,nation_id,passport_num,mrn,visit_code,gender,reg_date,reg_time,repo_date,repo_time,img,admin_id,time)
     VALUES (:patient_name,:birthday, :result,:nationality,:nation_id,:passport_num,:mrn,:visit_code,:gender,:reg_date,:reg_time,:repo_date,:repo_time,:img,:admin_id,:_time)" );
     date_default_timezone_set('Africa/Cairo');
     $_time = date("Y/m/d . h:i:s");
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
        ":reg_time"             =>$reg_time,
        ":repo_date"            =>$repo_date,
        ":repo_time"            =>$repo_time,
        ":img"                  =>$img,
        ":admin_id"             =>$admin,
        ":_time"                =>$_time,
    ));
    echo "
    <script>
        toastr.success('Great ,successfully: Added event .')
    </script>";
    header("Refresh:3;url=all_patients.php"); 
}

/*
==========================
  check if user exist
==========================
*/

function check_user ( $email , $hased){
    global $con;
    $stmt = $con->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->execute(array($email));
    $rows = $stmt->fetch(PDO::FETCH_ASSOC);
    $count = $stmt->rowCount();
    if ($count){
        if( $rows['password'] == $hased ){
            $_SESSION['userid']    = $rows['id'];
            $_SESSION['username']  = $rows['username'];
            $_SESSION['useremail'] = $rows['email'];
            $_SESSION['reg_state'] = $rows['reg_state'];
            echo "
            <script>
                toastr.success('Welcome Back " . $_SESSION['username'] . " .')
            </script>";

            if($rows['reg_state'] == "0"){
                header("Refresh:3;url=user_home.php");
            }else{
                header("Refresh:3;url=seller_profile.php");
            }

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



/*=====================start_members_function=============================*/
/*
==========================  
  insert_member
==========================
*/
function insert_member($user_name,$email,$birthday,$phone,
$commity,$season,$college_name,$college_year,$about,$img,$old_member,$facebook,$linkedIn  )
{

global $con;
 $stmt=$con->prepare("INSERT INTO 
        members(`name`,`email`,`birthday`,`phone`,`commity`,`season`,`college-name`, `college-year`,`about`,`img`,`old-member`,`facebook`,`linkedIn` )
        VALUES (:zuser,:zemail,:zbirthday,:zphone,:zcommity,:zseason,:zcollege_name, :zcollege_year,:zabout,:zimg,:zold_member,:zfacebook,:zlinkedIn) ");
        $stmt->execute(array(
            ":zuser"        =>$user_name, 
            ":zemail"       =>$email,
            ":zbirthday"    =>$birthday, 
            ":zphone"       =>$phone, 
            ":zcommity"     =>$commity, 
            ":zseason"      =>$season,
            ":zcollege_name"=>$college_name,
            ":zcollege_year"=>$college_year,
            ":zabout"       =>$about, 
            ":zimg"         =>$img,
            ":zold_member"   =>$old_member, 
            ":zfacebook"    =>$facebook, 
            ":zlinkedIn"    =>$linkedIn 
        ));
        echo "
        <script>
            toastr.success('Great ,successfully: member  added .')
        </script>";
        header("Refresh:3;url=all_members.php"); 
}
function insert_board_member($name,$email,$password,$birthday,$phone,$position,
$commity,$season,$college_name,$college_year,$about,$img,$old_member,$facebook,$linkedIn  )
{

global $con;
 $stmt=$con->prepare("INSERT INTO 
        board(`name`,`email`,`password`,`birthday`,`phone`,`position`,`commity`,`season`,`college_name`, `college_year`,`about`,`img`,`old_member`,`facebook`,`linkedIn` )
        VALUES (:zuser,:zemail,:zpassword,:zbirthday,:zphone,:zposition,:zcommity,:zseason,:zcollege_name, :zcollege_year,:zabout,:zimg,:zold_member,:zfacebook,:zlinkedIn) ");
        $stmt->execute(array(
            ":zuser"        =>$name, 
            ":zemail"       =>$email,
            ":zpassword"    =>$password,
            ":zbirthday"    =>$birthday, 
            ":zphone"       =>$phone, 
            ":zposition"    =>$position,
            ":zcommity"     =>$commity, 
            ":zseason"      =>$season,
            ":zcollege_name"=>$college_name,
            ":zcollege_year"=>$college_year,
            ":zabout"       =>$about, 
            ":zimg"         =>$img,
            ":zold_member"   =>$old_member, 
            ":zfacebook"    =>$facebook, 
            ":zlinkedIn"    =>$linkedIn 
        ));
        echo "
            <script>
                toastr.success('Great ,successfully: member  added .')
            </script>";
            header("Refresh:3;url=all_board.php"); 
}

/*
==========================  
  select_member_by_id
==========================
*/
function select_member_by_id($table ,$value_field){
    global $con;
    $stmt1       = $con->prepare("SELECT * FROM $table where `id`=?") ;
    $stmt1       ->execute(array($value_field));
    $row   =$stmt1 ->fetch();
    return $row;
  }
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
        update_member
   ==========================
*/
function update_member($user_name, $email,$birthday, $phone,$commity, $season,$college_name,  $college_year,$about, $img,$old_member, $facebook, $linkedIn, $id){
    global $con;
   $stmt= $con->prepare ("UPDATE members SET `name`=?,`email`=?,`birthday`=?,`phone`=?,`commity`=?,`season`=?,`college-name`=?, `college-year`=?,`about`=?,`img`=?,`old-member`=?,`facebook`=?,`linkedIn`=? WHERE `id`=?");
   $stmt ->execute(array(
       $user_name, $email,$birthday, $phone,$commity,$season,$college_name,  $college_year,$about, $img,$old_member, $facebook, $linkedIn, $id));
       echo "
       <script>
           toastr.success('Great ,successfully: member update .')
       </script>";
       header("Refresh:2;url=all_members.php"); 
}
  /*
   ==========================  
        update_board
   ==========================
*/

function update_board_member($name, $email,$password,$birthday, $phone, $position,$commity, $season,$college_name,  $college_year,$about, $img,$old_member, $facebook, $linkedIn, $id){
    global $con;
   $stmt= $con->prepare ("UPDATE board SET `name`=?,`email`=?,`password`=?,`birthday`=?,`phone`=?,`position`=?,`commity`=?,`season`=?,`college_name`=?, `college_year`=?,`about`=?,`img`=?,`old_member`=?,`facebook`=?,`linkedIn`=? WHERE `id`=?");
   $stmt ->execute(array(
       $name, $email,$password,$birthday, $phone, $position,$commity,$season,$college_name,  $college_year,$about, $img,$old_member, $facebook, $linkedIn, $id));
       echo "
       <script>
           toastr.success('Great ,successfully: member update .')
       </script>";
       header("Refresh:2;url=all_board.php"); 
}

/*
   ==========================  
        delete_by_id
   ==========================
*/
function delete_by_id($table ,$id_user){
    global $con;
     $stmt1 = $con -> prepare("DELETE FROM $table WHERE `id`=:id");
     $stmt1->bindParam(":id",$id_user);
     $stmt1->execute();
   }
/*=====================end_members_function=============================*/
/*=====================start event functions============================*/

/*
   ==========================  
        edit event 
   ==========================
*/
function editEvent($eventName,$eventSeason, $eventYear, $eventImg, $eventDescription, $eventLink,$id){
    global $con;
    $stmt=$con->prepare ("UPDATE events SET `name`=?,`season`=?, `year`=?,`img`=?,`description`=?,`link`=? WHERE `id`=?");
    $stmt->execute(array($eventName,$eventSeason, $eventYear, $eventImg, $eventDescription, $eventLink,$id));
    
    echo "
    <script>
        toastr.success('Great ,successfully: Edited event .')
    </script>";
    header("Refresh:3;url=all_events.php"); 

}

/*
   ==========================  
        edit admin 
   ==========================
*/
function editAdmin($name,$email, $hashed, $reg_state,$id){
    global $con;
    $stmt=$con->prepare ("UPDATE admins SET `name`=?,`email`=?, `password`=?,`role`=? WHERE `id`=?");
    $stmt->execute(array($name,$email, $hashed, $reg_state,$id));
    echo "
    <script>
        toastr.success('Great ,successfully: Edited Admin .')
    </script>";
    header("Refresh:3;url=all_admins.php"); 
}

/*
   ==========================  
       count members from database by commite name 
   ==========================
*/
function count_comittee_members($colume,$databname,$commity){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname WHERE commity = ?");
    $stmt->execute(array($commity));
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*
   ==========================  
       get the head and the vice of the comittee
   ==========================
*/
function select_head_vice($databname,$commity,$position){
    global $con;
    $stmt = $con->prepare("SELECT * From $databname WHERE commity = ? AND position=?");
    $stmt->execute(array($commity,$position));
    $row   =$stmt ->fetch();
    return $row;
}

/*
==========================
    get members by committe name
==========================
*/

function membersBy_comm($commity){
    global $con;
    $stmt = $con->prepare("SELECT * FROM members WHERE commity=?");
    $stmt->execute(array($commity));
    $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
    return $rows;
}

/*
==========================  
  select All Admins
==========================
*/
function select_Admins(){
    global $con;
    $stmt = $con->prepare("SELECT * FROM admins");
    $stmt->execute();
    $row   =$stmt ->fetchAll(PDO::FETCH_ASSOC);
    return $row;
  }

  /*
==========================  
count Rows from Database By/ Amr Mohamed
==========================
*/

function count_users($colume,$databname){
    global $con;
    $stmt = $con->prepare("SELECT COUNT($colume) From $databname");
    $stmt->execute();
    $rows = $stmt->fetchColumn();
    return $rows;
}


/*

    date_default_timezone_set('Africa/Cairo');
    $_time = date("Y/m/d . h:i:s");


*/