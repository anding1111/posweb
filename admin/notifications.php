<?php include('header.php'); ?>


<?php if(checkActiveSession() OR checkAdmin() ) { ?>


<?php include('left_menu.php'); ?>

<?php include('body/notification.php'); ?>


<?php include('footer.php'); ?>


<?php } else { 

    redirectTo('../index.php', 0);
}
?>
