<?php include('header.php'); ?>


<?php if(checkActiveSession()) { ?>

<?php //include('leftmenu.php'); ?>

<?php include('left_menu.php'); ?>

<?php include('body/dashboard.php'); ?>


<?php include('footer.php'); ?>


<?php } else { 

    redirectTo('../index.php', 0);
}
?>
