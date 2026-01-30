<?php
include('../../autoloadfunctions.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if (@$_POST['dId']) {

    $dId = $_POST['dId'];
    $dSaldo = $_POST['dSaldo'];

    //current time now
    $nowTime = date("Y-m-d H:i:s");

    //logged in shop ID
    $loggedInShop = $_SESSION['shId'];

    //generate invoice number
    $consulta = $conexion->query("SELECT * FROM orders WHERE `shId` = '" . $loggedInShop . "' AND `orEnable` = 1 ORDER BY invId DESC LIMIT 1");
    if ($consulta->num_rows > 0) {
        $result = mysqli_fetch_object($consulta);
        $invNum = $result->invId + 1;
    } else {
        $invNum = 1;
    }

    // Perform query
    if ($qry = $con->query("INSERT INTO orders VALUES(
        '0',
        '" . $invNum . "', 
        '0',
        '" . $dId . "',                                       
        '0',
        '0',
        '0',
        '0',
        '" . $dSaldo . "',                                    
        '1',
        '" . $nowTime . "',
        '',
        '1',
        '" . $loggedInShop . "',
        '" . $_SESSION['usId'] . "',
        '" . $_SESSION['idStore'] . "'
    )")) {
        echo $invNum;
        // Free result set
        // $qry->free_result();
    }
    // $con->close();
}

if (@$_POST['dIdSupplier']) {

    // $con = new mysqli("localhost", "root", "", "teinnova");

    $pIdSupplier = $_POST['dIdSupplier'];
    $puAbono = $_POST['dSaldo'];

    //current time now
    $nowTime = date("Y-m-d H:i:s");

    //logged in user ID
    $loggedInUser = $_SESSION['uId'];

    //logged in shop ID
    $loggedInShop = $_SESSION['shId'];

    $qry = $con->query("INSERT INTO purchases VALUES(
                            '0',
                            '" . $pIdSupplier . "', 
                            '0',
                            '" . $puAbono . "',                                       
                            '" . $loggedInUser . "',
                            '" . $nowTime . "',
                            '0',
                            'Abono',
                            '" . $loggedInShop . "'
                        )") or die(mysqli_error($con));
}

exit;
