<?php include('header.php'); ?>


<?php if(checkActiveSession()) { ?>

<?php include('left_menu.php'); ?>

<?php include('body/validate-pay.php'); ?>


<?php include('footer.php'); ?>


<?php } else { 

    redirectTo('../index.php', 0);
}
?>
