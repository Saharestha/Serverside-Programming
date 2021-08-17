<?
	//include the conn file
	include('conn.php');
?>

<html>
	<head>
		<style>
		
			select{
				width:300px;
				height:30px;
			}
			.cen{
				width:300px;
				height:30px
			}
		</style>

		<script>
			//Client side validation
			function appCheck()
			{
				//CHeck if service is selected
				var is_checked=false;
				for (var i=0; i<document.form1.elements.length; i++)
				{
					
					if(document.form1.elements[i].type=="checkbox" && document.form1.elements[i].checked==true)
					{
						is_checked=true;
						break;
					}
				}
				if (is_checked==false)
				{
					alert("Please select service");
					return false;
				}
				
				//check if time has been selected
				if(document.form1.time.value=="-----Select Time-----")
				{
					alert ("Please select time.");
					return false;
				}
				//check if stylist has been selected
				if(document.form1.stylist.value=="-----Select Stylist-----")
				{
					alert ("Please select stylist.");
					return false;
				}
				
			}
			
			function price()
			{
				
				alert("The prices for services:\n Haircut: 40.00\n Hair Styling:  100.34\n Hair Coloring:  200.09\n Manicure and Pedicure: 95.00\nHair Extension:  200.87");
				return false;
			}
		
		
		</script>
	</head>	

	<body><br><br>
		
		<table align="center" style="background-color:rgba(255,255 ,0, 0.1);padding:15px; font-size:20px">
			<tr><td align="center" colspan="2"><h2>Make Appointment</h2></td></tr>
			
			<? 
				//if session has not been set or startes
				if(empty($_SESSION))
				{
					echo "<p align='center'><font color='red'>Please login before making an appointment</font></p>";
				}
			?>
			<!--Create form to set the appointment-->
			<form method="post" onSubmit="return appCheck()" name="form1" action="setAppointment.php">
				
				<tr><td></td>
				<!--to add images in the table-->
				<td rowspan="6" style="padding-left:50px"><img src="image/style.jpg" height="200px" width="220px">
				<img src="image/cut.jpg" height="200px" width="220px"><br>
				<img src="image/color.jpg" height="200px" width="220px">
				<img src="image/hair.jpg" height="200px" width="220px"><br>
				<img src="image/mp.jpg" height="200px" width="220px">
				<img src="image/salon.jpg" height="200px" width="220px">
				
				</td></tr>
				<tr><td><b>Choose services: </b><br>
				<?
					//query to select services
					$ser="select * from services";
					$query=mysqli_query($conn, $ser);
					//to fetch services from database in type checkbox
					while($row2=mysqli_fetch_row($query))
					{
						if(isset($_POST["submit"]) )
						{
							echo "<input type='checkbox' name='ser[]' value='$row2[0]' checked>$row2[1]<br>";
						}
						else
						{
							echo "<input type='checkbox' name='ser[]' value='$row2[0]'>$row2[1]<br>";
						}
					}
				?>
					<br>
					<font size="3px">Click <a href="price.html" onClick="return price()">here</a> to check the price.  </font><br><br></td></tr>
					<!--To add date in the form-->
				<tr><td><b>Select Date: </b><br><input type="date" name="date" class="cen" min="<? echo date('Y-m-d')?>" required>
				<br><br></td></tr>
				<!--To add drop down list for time-->
				<tr><td><b>Select Time: </b></b><br><select name="time">
				<?
					$atime=array("-----Select Time-----","10:00 am", "11:00 am", "12:00 pm", "1:00 pm", "5:00 pm", "6:00 pm", "7:00 pm", "8:00 pm" );
					for ($i=0;$i<=count($atime)-1;$i++)
					{
						if(!empty($time) && $time=$atime[$i])						
							echo "<option value=\"$atime[$i]\" selected>$atime[$i]</option>";
						else
							echo "<option value=\"$atime[$i]\">$atime[$i]</option>";
					}
				?>
					</select><br><br></td></tr>
					<!--To add drop down list for time-->
				<tr><td><b>Select Stylist:</b><br><select name="stylist">
				<?
					// to fetch employee name from the database
					$ser1="select * from employee";
					$query1=mysqli_query($conn, $ser1);
					echo "<option value='-----Select Stylist-----'>-----Select Stylist-----</option>";
					while($row3=mysqli_fetch_row($query1))
					{
						if(!empty($stylist) && $stylist=$row3[1])						
							echo "<option value=\"$row3[0]\" selected>$row3[1]</option>";
						else
							echo "<option value=\"$row3[0]\">$row3[1]</option>";
					}
				?>
					</select>
					<br><br></td></tr>
					<!--To enter if they have any additional services -->
				<tr><td><b>Add any additional services/remarks:</b> <br>
					<font size="1px">(Additonal services charge will be informed via email)</font><br>
					<textarea cols="40" rows="5" name="addser"></textarea>
				<tr><td align="right"><input type="submit" name="appoint" value="Submit" style="width:100px; height:30px; border-radius:7px; font-size:17px"></td></tr>	
					
			</form>
			<!--For customers o view their appointments-->
			<form action="ViewApp.php" method="get">
			<tr><td align="right"><input type="submit" name="view" value="View Appointments" style="width:150px; height:30px; border-radius:7px; font-size:17px">
			<input type="hidden" value="<??>"></td></tr></form>
		</table>
</body>

</html>	