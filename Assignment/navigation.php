<style>
	.nav{
		background-color:#d27979;
		font-size:16px;
		margin-left:70px;
		border:none;
		text-decoration:underline;
		font-weight:bold	
	}

</style>
<?
	//add navigation bar
	echo "<form action='index.php?' method='get'>";
	echo "<input type='submit' name='nav' value='Main' style='width:150px; height:40px' class='nav'>";
	echo "<input type='submit' name='nav' value='Services' style='width:150px; height:40px' class='nav'>";
	echo "<input type='submit' name='nav' value='Make Appointment' style='width:150px; height:40px' class='nav'>";
	echo "<input type='submit' name='nav' value='Contact' style='width:150px; height:40px' class='nav'>";
	echo "</form>";
?>