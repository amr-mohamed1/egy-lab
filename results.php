<?php
session_start();
ob_start(); 
$style="result.css";
include 'init.php';
if(isset($_GET['id']) && is_numeric($_GET['id'])){
    $id =(int)$_GET['id'];
    $table="patients";
    $patient_data=select_by_id($table ,$id);
    
    }
?>

<div class="container pb-5">
    <div class="row">
        <div style="margin: auto;" class="col-md-6">
            <img style="display: block;width: 70%;margin: auto;margin-bottom: 30px;" src="img/misr-logo.jpg" alt="logo">
            <img style="display: block;width: 35%;margin: auto;border-radius: 50%;" src="img/client.png" alt="patient">
        </div>
        <div class="col-md-12 mt-5">
            <h3 class="test_name">PCR testing for SARS-CoV2 Test Result</h3>
            <div class="row">
                <div class="col-md-6"><p class="p_name"><span style="font-size: 20px;color:#444">Patient Name:</span><br>RAGIA FOUAD ABDELAZIZ ASKAR</p></div>
                <div class="col-md-6"><p class="result">Negative</p></div>
            </div>
        </div>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-4 mb-5">
                <h3>MRN : </h3>
                <p>N1152486</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>National Num : </h3>
                <p>28506091601661</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Date Of Birth : </h3>
                <p>09/06/1985</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Passport Num : </h3>
                <p>A29068057</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Nationality : </h3>
                <p>Egyptian</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Gender : </h3>
                <p>Female</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Visit Code : </h3>
                <p>N20211024050010</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Registration Date : </h3>
                <p>27/10/2021 08:06 AM</p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Reporting Date : </h3>
                <p>27/10/2021 04:11 PM</p>
            </div>
        </div>

    <h3 class="copy_rights">
        Test Performed By : <br>
        Misr International Lab - Cairo - Egypt
    </h3>
    <img src="img/iso.png" alt="iso">

    </div>
</div>


<?php 
require_once "./includes/template/footer.php";
ob_end_flush();?>
