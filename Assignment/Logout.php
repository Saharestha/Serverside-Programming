<?
	//destroy the session with the user id
	session_start();
	session_destroy();
	
	//diect them to login page
	header('location:index.php?login=Log+In%2FSign+Up');
?>
	
