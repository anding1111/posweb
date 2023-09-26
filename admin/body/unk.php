<?php  

include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

    if ( $existingUName != $uName ) {
        //check uniqueness
        if ( !checkUniqueUsername( $uName ) ) {


            
            //current time now
            $nowTime = date("Y-m-d H:i:s");

            $update = "UPDATE users SET uName = '$uName', uType = '$uType' WHERE uId = '$uId' ";

            $qry = mysqli_query($con,$update) or die(mysqli_error($con));


            if ( $qry ) {

                $insertSuccess = 1;

            } else{

                $insertError = 1;
            }


        } else{

            //set used variable
            $uniquenessError = 1;

        }

 
    }

        
?>
