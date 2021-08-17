<?
	include('conn.php');
	session_start();
	if(!empty($_SESSION))			//check if session exists
	{
		$id=$_SESSION['id'];
		
	
		if(isset($_GET['view']))
		{
			//to select the appointment created by the customer
			$appv="select appointment.app_date, customer.cus_name, customer.cus_email, appointment.app_day, appointment.app_time, group_concat(services.ser_name),  employee.emp_name,appointment.app_add, sum(services.ser_price) 
			from employee, customer, appointment, services where employee.emp_id=appointment.emp_id and customer.cus_id=appointment.cus_id and appointment.ser_id=services.ser_id and customer.cus_id=$id group by appointment.app_date";
			$ex=mysqli_query($conn, $appv);
			
			echo "<body style='background-image:url(image/Background1.jpg);background-size:100% 100%'>";
			echo "<table height='10%' width='100%' style='border-collapse: collapse;background-color:black'>
			<tr><td><h1 align='center'><font color='white'>Appointment History</font></h1></td></tr></table><br><br><br>";
			echo "<table border='1' style='background-color:rgba(0,0,0, 0.1); padding:30px; width:100%;height:200px '>
			
			<tr><th>Appointment Date</th><th>Customer Email</th><th>Appointment Day</th><th>Appointment Time</th><th>Services</th><th>Stylist</th><th>Additional Service</th><th>Total Sum</th></tr>";
			//to get all the appoints swet by the customer
			while($d =mysqli_fetch_row($ex))
			{
				echo "<tr><td>$d[0]</td><td>$d[2]</td><td>$d[3]</td><td>$d[4]</td><td>$d[5]</td><td>$d[6]</td><td>$d[7]</td><td>RM $d[8]</td></tr>";
			}
			
			
			echo "</table>";
			
			//to create form to update time of the appointment
			echo "<br><br><form action='update.php' method='get'>
			
			<input type='hidden' name='id' value='$id'>
			Select the date and time of the appointment to be updated: <input type='date' name='udate'> &nbsp&nbsp&nbsp
			<input type='text' name='utime' placeholder='time'><br>
			Click here to update time of appointments 
			<input type='submit' name='update' value='Update'></form>";
			
			
			echo "Go back to <a href='index.php?nav=Main'>Home Page</a></body>";
		}
		
		else
		{
			//to view appointment by the employee
			//queyr to get the employee name
			$sel4="select emp_name from employee where emp_id=$id";
			$que=mysqli_query($conn, $sel4);
			$show1=mysqli_fetch_row($que);
			
			
			$sel3="select appointment.app_date, customer.cus_name, customer.cus_email, appointment.app_day, appointment.app_time,  group_concat(services.ser_name), appointment.app_add 
			from employee, customer, appointment, services where employee.emp_id=appointment.emp_id and customer.cus_id=appointment.cus_id and appointment.ser_id=services.ser_id and employee.emp_id=$id group by appointment.app_date";
			$quer=mysqli_query($conn, $sel3);
			
			
			echo "<body style='background-image:url(image/Background1.jpg);background-size:100% 100%'>";
			echo "<font align='center'><h2>Hello $show1[0]</h2><h4>View your appointments!!</h4></font><br><br>";
			//show the appointments for the employee logged in
			echo "<table border='1' style='background-color:rgba(0,0,0, 0.1); padding:30px; width:100%; height:150px; margin-left:auto;margin-right:auto;'>
			<tr><th>Appointment Date</th><th>Customer Name</th><th>Customer Email</th><th>Appointment Day</th><th>Appointment Time</th><th>Services</th><th>Additional Service</th></tr>";
				while($show=mysqli_fetch_row($quer))
				{
					echo "<tr><td>$show[0]</td><td>$show[1]</td><td>$show[2]</td><td>$show[3]</td><td>$show[4]</td><td>$show[5]</td><td>$show[6]</td></tr>";
				}
				echo "</table>";
			
			//form to delete the completed appointments
			echo "<br><br><form action='delete.php' method='get'>
			Click here to delete the completed appointments 
			<input type='hidden' name='id' value='$id'>
			<input type='submit' name='delete1' value='delete'></form>";
			
			//Button to redirect the employees to teh view feedback page
			echo "<form action='ViewFeed.php?' method='get'>
			Click here to view feedbacks for Salon 
			
			<input type='submit' name='feed' value='Feedbacks'></form>";
		
			//To signout and redirect them to login page
			echo "Signout and Go back to <a href='Logout.php'>Login Page</a>";

		echo "</body>";
		}
	}
	else
	{
		//required to login to view the page
		echo '<script type="text/javascript">';
		echo 'alert("Please login!");'; 
		echo 'window.location.href="index.php?login=Log+In%2FSign+Up";';
		echo '</script>';
	}
?>