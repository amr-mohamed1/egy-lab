<?php       
$style="updateMember.css";
include "init.php";
$board=getAllData('patients');
/*if(!isset($_SESSION['username'])){
echo "<div class='alert alert-danger'>you can not see this page id not exist</div>";
    header("refresh:5;url=index.html");
    exit();}*/?>
<div id="layoutSidenav">     
    <?php 
      require './layout/sidNav.php';
    ?> 
    <div id="layoutSidenav_content">
      <div class="container-fluid ">
        <div class="allContent">

          <div class="tableOfHosters table-responsive">
              <a href="add_board_member.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">Add  <i class='bx bxs-user-plus'></i></button></a>
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
                                    Branch Board
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
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
                                              <th>Update</th>               
                                              <th>Delete</th> 
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
                                              <th>Image</th>   
                                              <th>QR Code</th>                
                                              <th>Update</th>                          
                                              <th>Delete</th> 
                                              </tr>            
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($board as $boardMember){
                                            echo"<tr>";
                                                    echo "<td>".  $boardMember['patient_name']  	."</td>";
                                                    echo "<td>".  $boardMember['birthday']      	."</td>";
                                                    echo "<td>".  $boardMember['result']     		."</td>";
                                                    echo "<td>".  $boardMember['nationality']      	."</td>";
                                                    echo "<td>".  $boardMember['nation_id']    	."</td>";
                                                    echo "<td>".  $boardMember['passport_num']  	   	."</td>";
                                                    echo "<td>".  $boardMember['mrn'] ."</td>";
                                                    echo "<td>".  $boardMember['visit_code'] ."</td>";
                                                    echo "<td>".  $boardMember['gender'] ."</td>";
                                                    echo "<td>".  $boardMember['reg_date'] . " / " . $boardMember['reg_time'] ."</td>";
                                                    echo "<td>".  $boardMember['repo_date'] . " / " . $boardMember['repo_time'] ."</td>";?>

                                                        <td>
                                                            <img src="./img/Patients/<?php echo $boardMember['img'];?>" width="100" height="100">
                                                        </td>;
                                                        <td>
                                                        <a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.amr-eissa.com?id=<?php echo $boardMember['id'] ?>%2F&choe=UTF-8" download="filename">
                                                                <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fwww.amr-eissa.com?id=<?php echo $boardMember['id'] ?>%2F&choe=UTF-8" alt="W3Schools" width="104" height="142">
                                                                </a>
                                                        </td>;
                                                            
                                                            <?php  
                                                    echo "<td>
                                                    <a href='update_board_member.php?id=".$boardMember['id']. "'
                                                    class='btn editbtn btn-primary m-2' style='display: flex;'><i class='bx bxs-edit m-1 '></i> Edit</a> " . "</td>";
                                                    echo "<td>
                                                    <a href='delete_board_member.php?id=".$boardMember['id']. "'
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