<?php       
ob_start();
session_start();
$style="updateMember.css";
include "init.php";
if(isset($_SESSION['role'])){
    if(isset($_GET['id']) && is_numeric($_GET['id'])){
        $id =(int)$_GET['id'];
require './layout/topNav.php';
$patients=getPatient_with_admin('patients',$id);
/*if(!isset($_SESSION['username'])){
echo "<div class='alert alert-danger'>you can not see this page id not exist</div>";
    header("refresh:5;url=index.html");
    exit();}*/?>
    <style>
        .fixed-table-toolbar{
            width:0px;
            margin: auto;
            margin-bottom: 20px;
        }
    </style>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

          <div class="tableOfHosters table-responsive">
              <a href="add_patient.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">Add  <i class='bx bxs-user-plus'></i></button></a>
              <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Egypt International Lab</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">All Patients</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    All Patients
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <div id="toolbar" class="select">
                                        <select style="display: none;" class="form-control">
                                        </select>
                                </div>
                                <table class="table table-bordered text-center" data-show-export="true"
                                    data-toolbar="#toolbar" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                              <th>Admin Name</th>
                                              <th>Name</th>
                                              <th>Date Of Birth</th>
                                              <th>Result</th>
                                              <th>Nationality</th>
                                              <th>National Num</th>
                                              <th>Passport Num</th>
                                              <th>MRN</th>
                                              <th>Visit Code</th>
                                              <th>Gender</th>
                                              <th>Added Date</th>
                                              <th>Image</th>               
                                              <th>QR Code</th>      
                                              <th>PDF Page</th>                        
                                              <th>Update</th>               
                                              <th>Delete</th> 
                                              </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th>Admin Name</th>
                                              <th>Name</th>
                                              <th>Date Of Birth</th>
                                              <th>Result</th>
                                              <th>Nationality</th>
                                              <th>National Num</th>
                                              <th>Passport Num</th>
                                              <th>MRN</th>
                                              <th>Visit Code</th>
                                              <th>Gender</th>
                                              <th>Added Date</th>
                                              <th>Image</th>    
                                              <th>QR Code</th>     
                                              <th>PDF Page</th>                          
                                              <th>Update</th>                          
                                              <th>Delete</th> 
                                              </tr>            
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($patients as $patients_data){
                                            echo"<tr>";
                                                    echo "<td>".  getData_with_id("admins",$patients_data['admin_id'])["username"]  	."</td>";
                                                    echo "<td>".  $patients_data['patient_name']  	."</td>";
                                                    echo "<td>".  $patients_data['birthday']      	."</td>";
                                                    echo "<td>".  $patients_data['result']     		."</td>";
                                                    echo "<td>".  $patients_data['nationality']      	."</td>";
                                                    echo "<td>".  $patients_data['nation_id']    	."</td>";
                                                    echo "<td>".  $patients_data['passport_num']  	   	."</td>";
                                                    echo "<td>". "N1152" . $patients_data['mrn'] ."</td>";
                                                    echo "<td>". "N2021102405" . $patients_data['visit_code'] ."</td>";
                                                    echo "<td>".  $patients_data['gender'] ."</td>";
                                                    echo "<td>".  $patients_data['time'] . "</td>";?>

                                                        <td>
                                                            <img src="./img/Patients/<?php echo $patients_data['img'];?>" width="100" height="100">
                                                        </td>
                                                        <td>
                                                        <a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Flocalhost/php_course/qr%20egypt%20lab/results.php?id=<?php echo rand(0,1000000)."-".$patients_data['id']."-".rand(0,1000).rand(0,100);?>%2F&choe=UTF-8" download="filename">
                                                                <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Flocalhost/php_course/qr%20egypt%20lab/results.php?id=<?php echo rand(0,1000000)."-".$patients_data['id']."-".rand(0,1000).rand(0,100);?>%2F&choe=UTF-8" alt="W3Schools" width="104" height="142">
                                                                </a>
                                                        </td>
                                                            

                                                        <td>
                                                            <a href='patient_data.php?id=<?php echo rand(0,1000000)."-".$patients_data['id']."-".rand(0,1000).rand(0,100);?>'
                                                            class='btn editbtn btn-primary m-2' style='display: flex;'><i class='bx bxs-edit m-1 '></i> PDF Page</a>                                                        
                                                        </td>

                                                            <?php  
                                                    echo "<td>
                                                    <a href='update_patient.php?id=".$patients_data['id']. "'
                                                    class='btn editbtn btn-primary m-2' style='display: flex;'><i class='bx bxs-edit m-1 '></i> Edit</a> " . "</td>";
                                                    echo "<td>
                                                    <a href='delete.php?from=patients&id=".$patients_data['id']. "'
                                                    class='btn deletebtn btn-danger m-2' style='display: flex;'><i class='bx bxs-user-minus m-1'></i> Delete</a> " . "</td>";
                                
                                            echo "</td>";?>
                                            </tr>
                                            <?php }?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>

          </div>
        </div>
      </div>
    </div>
</div>

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:siggin.php");
}
}else{
    header("Location:siggin.php");
}
ob_end_flush();