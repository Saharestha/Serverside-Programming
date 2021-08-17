<?
	include('conn.php');
	
	session_start();
	$id=$_SESSION['id'];
	// get date and time of the appointment to be updated
	$udate=$_GET['udate'];
	$utime=$_GET['utime'];
	$appv="select appointment.app_date, customer.cus_name, customer.cus_email, appointment.app_day, appointment.app_time, group_concat(services.ser_name),  employee.emp_name,appointment.app_add, sum(services.ser_price), employee.emp_id
			from employee, customer, appointment, services where employee.emp_id=appointment.emp_id and customer.cus_id=appointment.cus_id and appointment.ser_id=services.ser_id and customer.cus_id=$id and 
			appointment.app_date='$udate' and appointment.app_time='$utime' group by appointment.app_date";
			
			$ex=mysqli_query($conn, $appv);
			// to show data having the date and time enetered
			echo "<body style='background-image:url(image/Background1.jpg);background-size:100% 100%'>";
			echo "<table height='10%' width='100%' style='border-collapse: collapse;background-color:black'>
			<tr><td><h1 align='center'><font color='white'>Appointment History</font></h1></td></tr></table><br><br><br>";
			echo "<table border='1' style='background-color:rgba(0,0,0, 0.1); padding:30px; width:100%;'>
				<tr><th>Appointment Date</th><th>Customer Email</th><th>Appointment Day</th><th>Appointment Time</th><th>Services</th><th>Stylist</th><th>Additional Service</th><th>Total Sum</th></tr>";
			
			$d1=mysqli_num_rows($ex);
			if($d1>0)
			{
			$d =mysqli_fetch_row($ex);
			
			
			
			$days=array($d[4],'10:00 am', '11:00 am','12:00 pm','1:00 pm','5:00 pm','6:00 pm','7:00 pm','8:00 pm');
			//create a drop dow menu to select new time
			echo "<form method='post' action='update.php'><tr><td>$d[0]</td><td>$d[2]</td><td>$d[3]</td><td> 
			<select name='ctime' style='background-color:rgba(255, 255, 0, 0.1)'>"; 
			for($i=0; $i<count($days); $i++){echo"<option name='$days[$i]'>$days[$i]</option>";}
			echo "</select></td><td>$d[5]</td><td>$d[6]</td><td>$d[7]</td><td>RM $d[8]</td></tr>
			</table><br>
			<input type='hidden' name='udate' value='$udate'>
			<input type='hidden' name='utime' value='$utime'>
			
			<input type='hidden' name='usty' value='$d[9]'>
			<input type='submit' name='update' value='Update'></form>";
			}
	echo "<br><br><table><a href='index.php?nav=Make+Appointment'>Go Back</a></table>";	
?>

<?
	if(isset($_POST['update']))
	{
		//get values after update button is presses
		$sel=$_POST['ctime'];
		$udate=$_POST['udate'];
		$utime=$_POST['utime'];
		$usty=$_POST['usty'];
		 
		$upd="select * from appointment where app_date='$udate' and app_time='$utime' and emp_id=$usty";
		$que_upd=mysqli_query($conn, $upd);
		$ucheck=mysqli_num_rows($que_upd);
		//to get the apppointment details that is to be updated
		if($ucheck>0)
		{
			//to check if the stylists are free in the updated time
			$upd1="select * from appointment where app_date='$udate' and app_time='$sel' and emp_id=$usty";
			$que_upd1=mysqli_query($conn, $upd1);
			$ucheck1=mysqli_num_rows($que_upd1);
			echo $ucheck;
			//if the stylistas are free update the time
			if($ucheck1==0)
			{
				$ins="update appointment set app_time='$sel' where app_date='$udate' and emp_id=$usty and app_time='$utime'";
				mysqli_query($conn, $ins);
			}
			else
			{	
				echo 'Select another time';
			}	
		}
		
		//redirect them to niew appointment page
		header('location:ViewApp.php?view=View+Appointments');
		
	}
?>	
