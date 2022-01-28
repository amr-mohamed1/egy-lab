<?php
session_start();
ob_start(); 
$style="result.css";
include 'init.php';
if(isset($_GET['id'])){
$id =$_GET['id'];
$user_id = explode("-",$id);

    $table="patients";
    $patient_data=select_by_id($table ,$user_id[1]);
    if(!$patient_data){
        header("Location:index.php");
    }else{

?>

<div class="container pb-5">
    <div class="row">
        <div style="margin: auto;" class="col-md-6">
            <img style="display: block;width: 70%;margin: auto;margin-bottom: 30px;" src="img/data/lab 1 v2.png" alt="logo">
            <img style="display: block;width: 35%;margin: auto;border-radius: 50%;" src="img/Patients/<?php echo $patient_data["img"];?>" alt="patient">
        </div>
        <div class="col-md-12 mt-5">
            <h3 class="test_name">PCR testing for SARS-CoV2 Test Result</h3>
            <div class="row">
                <div id="left" class="col-md-6">
                <p class="p_name"><span style="font-size: 20px;color:#444">Patient Name:</span><br> <?php echo $patient_data["patient_name"]; ?></p>
                </div>
                <div id="right" class="col-md-6">
                <p style="<?php if($patient_data["result"]=="Positive"){ echo 'background-color:#f00 !important;border:5px solid #f00;';}?> " class="result mb-5"><?php echo $patient_data["result"]; ?></p>
                </div>
            </div>
        </div>
    </div>
    <div class="data">
        <div class="row">
            <div class="col-md-4 col-6 mb-5">
                <h3>MRN : </h3>
                <p>N1152<?php echo $patient_data["mrn"];?></p>
            </div>
            <!-- <div class="col-md-4 col-6 mb-5">
                <h3>National Num : </h3>
                <p><?php echo $patient_data["nation_id"];?></p>
            </div> -->
            <div class="col-md-4 col-6 mb-5">
                <h3>Date Of Birth : </h3>
                
                <p><?php
                echo date("d/m/Y",strtotime($patient_data["birthday"]));?></p>
            </div>
            <div class="col-md-4 col-6 mb-5">
                <h3>Passport Num : </h3>
                <p><?php echo $patient_data["passport_num"];?></p>
            </div>
            <div class="col-md-4 col-6 mb-5">
                <h3>Nationality : </h3>
                <p><?php echo $patient_data["nationality"];?></p>
            </div>
            <div class="col-md-4 col-6 mb-5">
                <h3>Gender : </h3>
                <p><?php echo $patient_data["gender"];?></p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Visit Code : </h3>
                <p>N2021102405<?php echo $patient_data["visit_code"];?></p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Registration Date : </h3>
                <p><?php
                $registr_date = explode("T",$patient_data["reg_date"]);
                echo date("d/m/Y",strtotime($registr_date[0])) . "  " ;
                echo date("h:i A",strtotime($registr_date[1]));
                
                ;?></p>
            </div>
            <div class="col-md-4 mb-5">
                <h3>Reporting Date : </h3>
                <p><?php 
                                $report_date = explode("T",$patient_data["repo_date"]);
                                echo date("d/m/Y",strtotime($report_date[0])) . "  " ;
                                echo date("h:i A",strtotime($report_date[1]));?></p>
                </p>
            </div>
        </div>

    <h3 class="copy_rights">
        Test Performed By : <br>
        El Salam Lab - Egypt
    </h3>
    <img src="img/data/1.png" alt="iso">

    </div>
</div>

<script>                
$(window).resize(function() {

if(window.innerWidth <= 775){
    $("#left").addClass( "order-12" );
    $("#right").addClass("order-1");
}else{
    $("#left").removeClass( "order-12" );
    $("#right").removeClass("order-1");
}
}).resize();</script>
<?php 
require_once "./includes/template/footer.php";
    }
}else{
    header("Location:index.php");
}
ob_end_flush();?>
