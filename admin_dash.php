<?php 
ob_start();
session_start();
$page="dash";
require "init.php";
if(isset($_SESSION['role'])){
$patients=getPatient_with_admin('patients',$_SESSION["userid"]);
require './layout/topNav.php';

$all_users = getAllData("members")
?>
    
    <div id="layoutSidenav">
           
 <?php 
    require './layout/sidNav.php';

 ?>
          
          
            <div id="layoutSidenav_content">
              
            
            
                  <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Elsalam Lab</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                        <div class="row">
                            <?php  if($_SESSION['role'] == "1"){  ?>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Add Admin</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo "./add_admin.php";?>">Go To Add Admin</a>
                                        <div class="small text-white"><i class="far fa-hand-point-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">All Admins</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo "./all_admins.php";?>">Go To All Admin</a>
                                        <div class="small text-white"><i class="far fa-hand-point-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Add Patient</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo "./add_patient.php";?>">Go To Add Patient</a>
                                        <div class="small text-white"><i class="far fa-hand-point-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">All Patient</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="./all_patients.php">Go To All Patient</a>
                                        <div class="small text-white"><i class="far fa-hand-point-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <?php }elseif($_SESSION['role'] == "0"){ ?>
                                <div class="col-md-6 col-12">
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Add Patient</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="<?php echo "./add_patient.php";?>">Go To Add Patient</a>
                                        <div class="small text-white"><i class="far fa-hand-point-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Your Patient</div>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="./all_patients.php">Go To All Patient</a>
                                        <div class="small text-white"><i class="far fa-hand-point-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <?php } ?>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    Your Patients
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table text-center table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                            <tr>
                                              <th>Name</th>
                                              <th>Date Of Birth</th>
                                              <th>Result</th>
                                              <th>Nationality</th>
                                              <th>National Num</th>
                                              <th>Passport Num</th>
                                              <th>MRN</th>
                                              <th>Visit Code</th>
                                              <th>Gender</th>
                                              <th>Registration Date</th>
                                              <th>Reporting Date</th>
                                              <th>Image</th>               
                                              <th>QR Code</th>               
                                              <th>PDF Page</th>               
                                              <th>Update</th>               
                                              <?php  if($_SESSION['role'] == "1"){  ?>                         
                                              <th>Delete</th> 
                                              <?php } ?>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                              <th>Name</th>
                                              <th>Date Of Birth</th>
                                              <th>Result</th>
                                              <th>Nationality</th>
                                              <th>National Num</th>
                                              <th>Passport Num</th>
                                              <th>MRN</th>
                                              <th>Visit Code</th>
                                              <th>Gender</th>
                                              <th>Registration Date</th>
                                              <th>Reporting Date</th>
                                              <th>Image</th>    
                                              <th>QR Code</th>      
                                              <th>PDF Page</th>                         
                                              <th>Update</th> 
                                              <?php  if($_SESSION['role'] == "1"){  ?>                         
                                              <th>Delete</th> 
                                              <?php } ?>
                                              </tr>            
                                        </tfoot>
                                        <tbody>
                                        <?php foreach($patients as $patients_data){
                                            echo"<tr>";
                                                    echo "<td>".  $patients_data['patient_name']  	."</td>";
                                                    echo "<td>".  $patients_data['birthday']      	."</td>";
                                                    echo "<td>".  $patients_data['result']     		."</td>";
                                                    echo "<td>".  $patients_data['nationality']      	."</td>";
                                                    echo "<td>".  $patients_data['nation_id']    	."</td>";
                                                    echo "<td>".  $patients_data['passport_num']  	   	."</td>";
                                                    echo "<td>". "N115" . $patients_data['mrn'] ."</td>";
                                                    echo "<td>". "N2021102405" .$patients_data['visit_code'] ."</td>";
                                                    echo "<td>".  $patients_data['gender'] ."</td>";
                                                    echo "<td>".  $patients_data['reg_date'] . "</td>";
                                                    echo "<td>".  $patients_data['repo_date'] . "</td>";?>

                                                        <td>
                                                            <img src="./img/Patients/<?php echo $patients_data['img'];?>" width="100" height="100">
                                                        </td>
                                                        <td>
                                                            <a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Felsalamlab.com/results.php?id=<?php echo rand(0,1000000)."-".$patients_data['id']."-".rand(0,1000).rand(0,100);?>%2F&choe=UTF-8" download="filename">
                                                                <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Felsalamlab.com/results.php?id=<?php echo rand(0,1000000)."-".$patients_data['id']."-".rand(0,1000).rand(0,100);?>%2F&choe=UTF-8" alt="W3Schools" width="104" height="142">
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
                                                    if($_SESSION['role'] == "1"){ 
                                                    echo "<td>
                                                    <a href='delete.php?from=patients&id=".$patients_data['id']. "'
                                                    class='btn deletebtn btn-danger m-2' style='display: flex;'><i class='bx bxs-user-minus m-1'></i> Delete</a> " . "</td>";
                                                    }
                                
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
                

<?php
require_once "./includes/template/footer.php";
}else{
    header("Location:siggin.php");
}
ob_end_flush();