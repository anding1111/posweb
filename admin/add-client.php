<?php include('header.php'); ?>


<?php if(checkActiveSession()) { ?>

<?php include('left_menu.php'); ?>

<?php include('body/add-client.php'); ?>


<?php include('footer.php'); ?>


<?php } else { 

    redirectTo('../index.php', 0);
}
?>
