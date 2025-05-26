<?php 

include('header.php');


if ( logOut() == 4 ) {
	
	redirectTo('../index.php', 1);

	echo '<div class="alert alert-success">Cierre de sesión satisfactorio</a>.
                            </div>';

}