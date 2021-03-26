<?php  


    $getUId = $_GET['uId'];

    //collect all informaion from database
    $qry = mysqli_fetch_object(mysqli_query($con, "SELECT * FROM client WHERE cID = '{$getCId}' ") );
    $update = "UPDATE users SET uFlag = 1 WHERE uId = '".$getUId."' ";

                $qry = mysqli_query($con, $update) or die(mysqli_error($con));
    ?>