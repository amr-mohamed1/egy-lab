<?php
session_start();
ob_start(); 
$style="data.css";
include 'init.php';
if(isset($_SESSION['role'])){
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

<!-- row 1 -->
    <div class="row">
        <div class="col-md-3">
            <div class="top_header_left">
                <img src="img/data/3.png" alt="header">
                <p style="font-size: 25px;font-weight: 700;font-family:'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;margin-left:10%;margin-top: -20%;">El Salam Lab</p>
            </div>
        </div>
        <div class="col-md-7">
            <div class="top_header_left">
                <img style="width: 60%;margin-left: 5%;" src="img/data/lab 1 v2.png" alt="مخلخ">
            </div>
        </div>
        <div class="col-md-2">
            <div class="top_header_right">
                <img src="img/Patients/<?php echo $patient_data["img"];?>" alt="patient">
            </div>
        </div>
    </div>


<!-- row 2 -->
    <div class="row pt-4">
        <div class="col-md-10">
            <div class="data_left">
                <div class="name"><span>Name &nbsp;&nbsp;&nbsp; :</span><p><?php echo $patient_data["patient_name"]; ?></p></div>


                <div class="row pt-2">
                    <div class="col-md-6 nation">
                    <span>MRN &nbsp;&nbsp;&nbsp; :</span> <p>N115<?php echo $patient_data["mrn"];?></p>
                    </div>
                    <div class="col-md-6 nation">
                    <span>Nationality &nbsp;&nbsp;&nbsp; :</span> <p><?php echo $patient_data["nationality"];?></p>
                    </div>
                </div>


                <div class="row pt-2 pb-2">
                    <div class="col-md-6 nation">
                    <span>Gender &nbsp;&nbsp;&nbsp; :</span> <p><?php echo $patient_data["gender"];?></p>
                    </div>
                    <div class="col-md-6 nation">
                    <span>Nation ID &nbsp;&nbsp;&nbsp; :</span> <p><?php echo $patient_data["nation_id"];?></p>
                    </div>
                </div>


                <div class="row">
                    <div class="col-md-6 nation">
                    <span>DOB/Age &nbsp;&nbsp;&nbsp; :</span> <p><?php
                echo date("d/m/Y",strtotime($patient_data["birthday"]));?> (47 Y)</p>
                    </div>
                    <div class="col-md-6 nation">
                    <span>Passport  &nbsp;&nbsp;&nbsp; :</span> <p><?php echo $patient_data["passport_num"];?></p>
                    </div>
                </div>

                <div class="row pt-2 pb-2">
                    <div class="col-md-6 nation">
                    <span>Location &nbsp;&nbsp;&nbsp; :</span> <p><?php echo $patient_data["nationality"];?></p>
                    </div>
                    <div class="col-md-6 nation">
                    <span>Reg Date  &nbsp;&nbsp;&nbsp; :</span> <p><?php
                $registr_date = explode("T",$patient_data["reg_date"]);
                echo date("d/m/Y",strtotime($registr_date[0])) . "  " ;
                echo date("h:i A",strtotime($registr_date[1]));
                
                ;?></p>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-6 nation">
                    <span>Ref. by Dr &nbsp;&nbsp;&nbsp; :</span> <p></p>
                    </div>
                    <div class="col-md-6 nation">
                    <span>Report Date &nbsp; :</span> <p><?php 
                                $report_date = explode("T",$patient_data["repo_date"]);
                                echo date("d/m/Y",strtotime($report_date[0])) . "  " ;
                                echo date("h:i A",strtotime($report_date[1]));?></p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-2">
            <div class="data_right">
                <!-- <img src="img/data/6.png" alt="qr"> -->
                <a href="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fmisrinternationallab.center/results.php?id=<?php echo rand(0,1000000)."-".$patient_data['id']."-".rand(0,1000).rand(0,100);?>%2F&choe=UTF-8" download="filename" style="width: 100%;height: 100%;">
                    <img src="https://chart.googleapis.com/chart?chs=300x300&cht=qr&chl=http%3A%2F%2Fmisrinternationallab.center/results.php?id=<?php echo rand(0,1000000)."-".$patient_data['id']."-".rand(0,1000).rand(0,100);?>%2F&choe=UTF-8" alt="W3Schools" width="500" style="width: 100%;height: 100%;" >
                </a>
            </div>
        </div>
    </div>
    <hr style="border:1px solid #000;">


<!-- row3   -->
    <h3 class="title">Molecular Biology</h3>
    <div class="row text-center">
        <div class="col-md-4">
            <P style="font-size: 20px;font-weight: 700;">Test</P>
        </div>
        <div class="col-md-3">
            <P style="font-size: 20px;font-weight: 700;">Result</P>
        </div>
        <div class="col-md-2">
            <P style="font-size: 20px;font-weight: 700;">Unit</P>
        </div>
        <div class="col-md-3">
            <P style="font-size: 20px;font-weight: 700;">Normal Range</P>
        </div>
    </div>

    <hr style="border: 1px dotted #555;">

    <div class="row text-center">
        <div class="col-md-4">
            <P style="font-size: 20px;font-weight: 700;">COVID-19 by RT-PCR</P>
        </div>
        <div class="col-md-3">
            <P style="font-size: 20px;font-weight: 700;"><?php echo $patient_data["result"]; ?></P>
        </div>
        <div class="col-md-2">
            <P style="font-size: 20px;font-weight: 700;">N/A</P>
        </div>
        <div class="col-md-3">
            <P style="font-size: 20px;font-weight: 700;"><?php echo $patient_data["result"]; ?></P>
        </div>
    </div>

    <div class="row pt-5">
        <div class="col-md-2">
            <h3 style="font-size: 20px;font-weight: 700;">Comment :</h3>
        </div>
        <div class="col-md-10">
            <p style="font-weight: 500;">
                Specimen: Nasopharyngeal swab, Oropharyngeal swab. <br>
                Multiplex Real Time PCR <br>

                Note: Severe Acute Respiratory Coronavirus 2 RNA Detection, is a qualitative PCR test.<br>
                ** Not Detected: indicates that SARS COV-2 RNA is either not present in the specimen or is present at a concentration below the assays's lower<br>

                limit of detection. This result may be influenced by the stage of the infection and the quality of the specimen collected for testing. Repeat test it deemed necessary after 72 hours.<br>

                ** Detected: Detected indicates that SARS-COV-2 RNA is present in this specimen. Results should be interpreted in the context of all available lab and clinical finding.<br>

                **Presumptive positive (ICONC)- indicates that only one of multiple genes is detected. Low vital load possible. Please send a repeat sample after 72-96 hours and correlate clinically.<br>

                **Imitations:
                1.	As all diagnostic tests, a definitive clinical diagnosis should not be based on the result of a single test but should only be made after all clinical and laboratory findings have been evaluated, Collection of multiple specimens from the same patient may be necessary to detect the virus.<br>

                2.	A false negative result may occur if a specimen is improperly collected, transported or handled. False negative results may also occur if amplification inhibitors are present in the specimen or if inadequate numbers of organisms are present in the specimen.<br>
                3.	If the virus mutates in the rRT-PCR target region, 2019-nCoV may not be detected or may be detected-less predictably. Inhibitors or other types of interference may produce a false negative result.<br>
                4.	This test cannot rule out diseases caused by other bacterial or viral pathogens.<br>

                End of report

            </p>
        </div>
    </div>


    <div class="row sig pt-3">
        <div class="col-md-4">
            <img style="margin-top: 40px;" src="img/data/معمل السلام.png" alt="sig">
        </div>
        <div class="col-md-4">
            <img src="img/data/السلان لاب.png" alt="sig">
        </div>
        <div class="col-md-4">
            <p style="font-weight: 700;text-align: center;">Approved By <br> Prof.Hala Elsakhawy</p>
            <img src="img/data/2.png" alt="sig">
        </div>
    </div>

    <!-- <div class="row mt-3">
        <div class="col-md-6">
            <img style="display: block;width: 70%;margin: auto;margin-top: 30px;" src="img/data/1.png" alt="data">
        </div>
        <div class="col-md-6">
            <img style="display: block;width: 30%;margin: auto;" src="img/data/3.png" alt="data">
        </div>
    </div> -->


    <div class="row mt-3">
        <div class="col-md-12">
            <img style="display: block;width: 60%;margin: auto;margin-top: 30px;" src="img/data/1.png" alt="data">
        </div>
    </div>




</div>

<script>                
// $(window).resize(function() {

// if(window.innerWidth <= 775){
//     $("#left").addClass( "order-12" );
//     $("#right").addClass("order-1");
// }else{
//     $("#left").removeClass( "order-12" );
//     $("#right").removeClass("order-1");
// }
// }).resize();
</script>
<?php 
require_once "./includes/template/footer.php";
    }
}else{
    header("Location:index.php");
}
}else{
    header("Location:siggin.php");
}
ob_end_flush();?>
