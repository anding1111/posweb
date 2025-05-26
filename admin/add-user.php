<?php include('header.php'); ?>


<?php if(checkActiveSession() OR checkClark() ) { ?>

<?php include('left_menu.php'); ?>

<?php include('body/add-user.php'); ?>


<?php include('footer.php'); ?>


<?php } else { 

    redirectTo('../index.php', 0);
}
?>
