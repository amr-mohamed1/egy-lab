<?php 
ob_start();
session_start();
include 'init.php';
if(isset($_SESSION['role'])){

if ($_GET['from'] == "admins" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $admin_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM admins WHERE id = :admin_id");
    $stmt->bindParam(":admin_id" , $admin_id);
    $stmt->execute();
    header("Location:all_admins.php");
}else if($_GET['from'] == "patients" && isset($_GET['id']) && is_numeric($_GET['id'])){
    $patient_id = $_GET['id'];
    $stmt = $con->prepare("DELETE FROM patients WHERE id = :patient_id");
    $stmt->bindParam(":patient_id" , $patient_id);
    $stmt->execute();
    header("Location:all_patients.php");
}
else{
    header("location:admin_dash.php");
}

require_once "./includes/template/footer.php";

}else{
    header("Location:siggin.php");
}

ob_end_flush();