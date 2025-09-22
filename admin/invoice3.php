<?php include('header.php'); ?>


<?php if(checkActiveSession()) { ?>

<?php include('left_menu.php'); ?>

<?php 
$invoiceType = checkPrinterType();
if($invoiceType == 2) {
include('body/invoices-normal.php');
} else { 
include('body/invoices-pos3.php');
} ?>

<?php include('footer.php'); ?>

<?php } else { 

    redirectTo('../index.php', 0);
}
?>
