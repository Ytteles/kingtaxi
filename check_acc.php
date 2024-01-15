<?php 
    require_once __DIR__.'/boot.php';
	
	// этот код не работает
    if (isset($_POST['button_submit'])) {
		if ($_SESSION['user_id']) {
		
		}
		else {
			flash('Вы не вошли в аккаунт');
			header('Location: acount/account.php');
		}
		
    }
	header('Location: index.php');
?>