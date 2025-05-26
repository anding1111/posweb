<?php  

include('../../autoloadfunctions.php');
$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if ( @$_POST['arrayData'] ) {

    $data=array();
    $data = $_POST['arrayData'];
    $status = $data['status'];

    if ($status === "APPROVED"){
        $estado = "APROBADA";
        $datetime = new DateTime($_POST['datePlan']);
        $intervalo_renew = new DateInterval('P1M');
        if ($_POST['typePlan'] == 2) {
            $intervalo_renew = new DateInterval('P1Y');
        }
        $datetime->add($intervalo_renew);
        $renew_date = $datetime->format('Y-m-d H:i:s');

        //Generate new reference to next invoice
        $new_reference = genReference(4);
        
        //Update Date Expire Plan and Status
        $update = "UPDATE shop SET `shEnable` = 1, `shDatePlan` = '".$renew_date."', `shReference` = '".$new_reference."' WHERE `shId` = '".$_SESSION['shId']."' ";
        $qryPay = $con->query($update) or die(mysqli_error($conexion));

        //Insert transaction data into transaction table
        $datetimeGTM = new DateTime($data["created_at"] );
        $intervaloGTM = new DateInterval('PT5H');
        $datetimeGTM->sub($intervalo);
        $pay_date = $datetimeGTM->format('Y-m-d H:i:s');
        $insert = $conexion->query("INSERT INTO transactions VALUES(
            '0',
            '".$data["id"]."',
            '".$data["reference"]."',                
            '".$_POST['customerEmail']."',
            '".$data["amount_in_cents"]."',
            '".$pay_date."',
            '".$data["payment_method_type"]."'
            )") or die(mysqli_error($conexion));
        }


    return 1;
}

?>