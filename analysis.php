<?php       
ob_start();
session_start();
$style="updateMember.css";
include "init.php";
if(isset($_SESSION['role']) && $_SESSION['role'] == "1"){
require './layout/topNav.php';
$admins=getAllData('admins');

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
              <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Elsalam Lab</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">Number of Patinets last 30 day</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    Number of Patinets last 30 day
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                              <th>Name</th>
                                              <th>Email</th>
                                              <th>Num of Patients per month</th>             
                                              <th>Admin Pathients</th>            
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Num of Patients per month</th>             
                                                <th>Admin Pathients</th>            
                                              </tr>            
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($admins as $admin_data){
                                            echo"<tr>";
                                                    echo "<td>".  $admin_data['username']  	."</td>";
                                                    echo "<td>".  $admin_data['email']      	."</td>";?>

                                                        <td> 
                                                <?php
                                                        $i=0;
                                                        $date= date("Y/m/d . H:i:s");
                                                        $patients = count_patients($admin_data["id"]);
                                                        foreach($patients as $data){
                                                            $date = explode("." , $data["time"]);
                                                            $now = time(); // or your date as well
                                                            $your_date = strtotime($date[0]);
                                                            $datediff = $now - $your_date;
                                                            $final_date = round($datediff / (60 * 60 * 24))-1;
                                                            if($final_date >=-1 && $final_date <= 30){
                                                               $i++;
                                                            }
                                                        }
                                                        echo $i;
                                                        
                                                        ?>
                                                         </td>
                                                         <?php
                                                    
                                                echo "<td>
                                                <a href='all_admin_patients.php?id=".$admin_data['id']."'
                                                class='btn editbtn btn-primary m-2'><i class='bx bxs-edit m-1 '></i> All Admin Patinets</a> " . "</td>";
                                
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
ob_end_flush();