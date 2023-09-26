<?php  
    include('../autoloadfunctions.php');
    if ( @$_POST['stId'] ) {
        
         //Update Store Variable
        $_SESSION['idStore'] = formItemValidation($_POST['stId']);
        echo "Cambio a " . $_SESSION['idStore']; 
    }
    ?>