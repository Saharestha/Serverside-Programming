<?
	//to connect the conn file
	include('conn.php');
	
	//get data from appointment .php page's form
	$date=$_POST['date'];
	$ser=$_POST['ser'];
	$time=$_POST['time'];
	$stylist=$_POST['stylist'];
	$addser=$_POST['addser'];
	
	//get day from the selected date
	$day =date('l', strtotime($date));
	
	//check if the stylists are free on the selected date and time
	$check="select * from appointment where app_date='$date' and app_day='$day' and app_time='$time' and emp_id=$stylist";
	$check1=mysqli_query($conn, $check);
	$find=mysqli_num_rows($check1);
	//if the user is logged in
	session_start();
	if(!empty($_SESSION))
	{		
		$id=$_SESSION['id'];
		//if the stylists are free, add the appointment
		if($find==0)
		{
			for($i=0; $i<count($ser); $i++)
			{
				$app="insert into appointment(app_date, app_day, app_time, app_add, ser_id, emp_id, cus_id) values ('$date','$day', '$time', '$addser', $ser[$i], $stylist, $id)";
				mysqli_query($conn, $app);
			}
			echo '<script type="text/javascript">';
			echo 'window.location.href="index.php?nav=Make+Appointment";';
			echo 'alert("Your appointment has been set!");'; 
			
			echo '</script>';
			
		}
		//if the stylists are not free alert to select another day or time
		else 
		{
			echo '<script type="text/javascript">';
			echo 'alert("Select another time or date!");'; 
			echo 'window.location.href="index.php?nav=Make+Appointment";';		
			echo '</script>';
		}
	}
	//if the users are not logged in redirect them to login page
	else
	{
		echo '<script type="text/javascript">';
		echo 'alert("Login to make an appointment!");'; 
		echo 'window.location.href="index.php?login=Log+In%2FSign+Up";';		
		echo '</script>';
	}
?>
<html>
<body style="background-image:url(image/Background1.jpg);background-size:100% 100%">
</body>
</html>
