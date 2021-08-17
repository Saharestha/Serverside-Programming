<?
	include('conn.php');
	//to show all the feedbacks for the salon
	$feed="select * from feedbacks";
	$fquery=mysqli_query($conn, $feed);
	
?>	
	<!--CREATE TABLE TO VIEW FEED-->
	<table height="10%" width="100%" style="border-collapse: collapse;background-color:black">
	<tr><td><h1 align="center"><font color="white">Feedbacks</font></h1></td></tr></table><br><br><br>
	<body style="background-image:url(image/Background1.jpg);background-size:100% 100%">
	<table border='1' width="60%" style="background-color:rgba(255,255,0, 0.1); padding:20px" align="center">
	<tr><th>Name</th><th>Email</th><th>Phone Number</th><th>Remarks</th><tr>
<?
	//show data from the databses
	while($show=mysqli_fetch_row($fquery))
	{
		echo "<tr><td>$show[1]</td><td>$show[2]</td><td>$show[3]</td><td>$show[4]</td><tr>";
	}
	
?>
</table><br>
<!--link to redirect user to view appointment page-->
<p align='center'>Go Back to <a href="ViewApp.php">View Appointment</a></p>