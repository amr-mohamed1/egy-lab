<?php       
$style="updateMember.css";
include "init.php";
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
              <a href="add_admin.php">  <button style="padding: 7px 25px;" type="button" name="add" class="btn btn-success ml-4 mt-5">Add  <i class='bx bxs-user-plus'></i></button></a>
              <main>
                    <div class="container-fluid">
                        <h1 class="mt-4">Egypt International Lab</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item">Dashboard</li>
                            <li class="breadcrumb-item active">All Admins</li>
                        </ol>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                    Branch Admins
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                <table class="table table-bordered text-center" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                              <th>Name</th>
                                              <th>Email</th>
                                              <th>position</th>             
                                              <th>Edit</th>            
                                                <th>Delete</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>position</th>             
                                                <th>Edit</th>            
                                                <th>Delete</th>
                                              </tr>            
                                        </tfoot>
                                        <tbody>
                                           <?php foreach($admins as $admin_data){
                                            echo"<tr>";
                                                    echo "<td>".  $admin_data['username']  	."</td>";
                                                    echo "<td>".  $admin_data['email']      	."</td>";

                                                    if($admin_data['role'] == 0){
                                                        echo "<td>". "Height Board" ."</td>";
                                                    }elseif($admin_data['role'] == 1){
                                                        echo "<td>". "Super Admin" ."</td>";
                                                    }elseif($admin_data['role'] == 2){
                                                        echo "<td>". "Admin" ."</td>";
                                                    }
                                                    
                                                echo "<td>
                                                <a href='update_admin.php?id=".$admin_data['id']."'
                                                class='btn editbtn btn-primary m-2'><i class='bx bxs-edit m-1 '></i> Edit</a> " . "</td>";
                                                echo "<td>
                                                <a href='delete_admin.php?id=".$admin_data['id']."'
                                                class='btn deletebtn btn-danger m-2'><i class='bx bxs-user-minus m-1'></i> Delete</a> " . "</td>";
                                
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