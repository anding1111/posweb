<?php

include('../autoloadfunctions.php');
// include('../vendor/autoload.php');

$con = new mysqli($server_db, $user_db, $password_db, $database_db);

if(isset($_POST["item_id"])) {

    $itemId = $_POST['item_id'];
    $pre_qry = mysqli_fetch_object($conexion->query("SELECT * FROM items WHERE pId = ".$itemId." AND `pEnable` = '1' AND `shId` = ".$_SESSION['shId']." AND `idStore` = ".$_SESSION['idStore']." "));
    $qry = $conexion->query("SELECT * FROM items WHERE idAux = ".$pre_qry->idAux." AND `pEnable` = '1' AND `shId` = ".$_SESSION['shId']." ");
    $numItems =  $qry->num_rows;
    
    $response = "
        <input type='hidden' id='idItem' value='".$itemId."'>
        <input type='hidden' id='qtyItem' value='".$pre_qry->pQuantity."'>
        <input type='hidden' id='numItems' value='".$numItems."'>";
    $response .= "<table class='table table-hover' border='0' width='100%'>";
    $response .= "<thead>
                <tr>                                
                    <th style='width:45%; text-align:left;'>Producto</th>                                
                    <th style='width:25%; text-align:center;'>Ubicación</th>
                    <th style='width:10%; text-align:right;'>Cantidad</th>
                    <th style='width:20%; text-align:right;'>Costo</th>
                </tr>
                <tbody style='max-height: 30vh; overflow-y: auto; overflow-x: hidden;'>";
                    while( $row = $qry->fetch_assoc() ){
                        $store= getStoreNameById($row['idStore']);
                        if ($_SESSION['idStore'] == $row['idStore']) {
                            $response .= "<tr style='background-color:#46B6E5;'>";
                        }else{
                            $response .= "<tr>";
                        }                                                  
                        $response .= "<td style='width:45%; text-align:left;'>".$row['pName']."</td>
                        <td style='width:25%; text-align:center;'>".$store->stName."</td>
                        <td id ='pQty' style='width:10%; text-align:right;'>".$row['pQuantity']."</td>
                        <td style='width:20%; text-align:right;'>".$row['pCost']."</td>";
                        $response .= "</tr>";        
                    }
                $response .= "</tbody>    
            </table>
        <b>
        <div class='col-sm-3 invoice-col' style='padding: 6px 12px; text-align: center;'>    
            Mover a:     
        </div>
        <div class='col-sm-6 invoice-col'>";    
        $stores = getAllStores(); 
        if ( $stores->num_rows > 1 ) {
         $response .= "<select class='form-control' id='store_receive'>";
            while($row = mysqli_fetch_array($stores) ){
                 if (intval($_SESSION['idStore']) != intval($row['stId'])) {
                   $response .= "<option value='" . $row['stId'] . "' > ". $row['stName'] . "</option>";
                 } 
            }
           $response .= "</select>";        
        }
        $response .= "</div>
        <div class='col-sm-3 invoice-col' style='padding-bottom:10px;'>  
         <input type='number' min='1' id='transferQty' class='form-control el-input__inner' value='0' required oninput='qtyTransfer()'";
         if ($pre_qry->pQuantity < 1){
             $response .= " disabled ";
         }
         $response .= ">  
        </div></b>";
    
    echo $response;
}
exit;

?>