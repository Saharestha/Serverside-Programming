<?
	//to include the conn file
	include('conn.php');
?>

<html>
	<style>
		.logi{
			border:none;
			text-decoration:underline;
			background-color:black;
			color:white
		}
		.link{
			text-decoration: underline;
			color:white
		}
	</style>

	<body>
		<h1 style="color:white; font-size:50px; text-shadow:2px 2px 2px #708090">
		<img src="image/name.png" width="27%" height="90%"> </img>
		<?
			//to check if session has been set
			session_start();
			if(!empty($_SESSION))
			{
				//to print customer name in header if logged in
				$id=$_SESSION['id'];
				//query to get customer name with the help of customer id
				$ql="select cus_name from customer where cus_id=$id";
				$q=mysqli_query($conn, $ql);
				$get=mysqli_fetch_row($q);
				
				
				echo "<form action='index.php?' method='get'>";
				echo"<div style='font-size:15px; padding:5px 35px 0 0; float:right; text-shadow:0 0 0 '>
				<a href='Logout.php' class='link' title='Logout'>Welcome ".$get[0]."</a></div>";
			}
			else
			{		
				//to display login and signup option in the header if not logged in
				echo "<form action='index.php' method='get'>";				
				echo'<div style="font-size:15px; padding:0px 35px 0 0; float:right; text-shadow:0 0 0 ">
				<input type="submit" name="login" value="Log In/Sign Up" class="logi"> </div></form></h1>';
			}
		?>
	</body>
</html>