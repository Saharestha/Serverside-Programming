<?
	include('conn.php');
	if(isset($_POST['remarks']))
	{
		//after submitting check if all data are ntered
		if(!empty($_POST['rname']) && !empty($_POST['remail']) && !empty($_POST['rphone']) && !empty($_POST['rfeed']))
		{
			$rname=$_POST['rname'];
			$remail=$_POST['remail'];
			$rphone=$_POST['rphone'];
			$rfeed=$_POST['rfeed'];
			// insert data into feedback table 
			$feed="insert into feedbacks(feed_name, feed_email, feed_phone, feed_remarks) values ('$rname','$remail','$rphone','$rfeed')";
			mysqli_query($conn, $feed);
			// alert that feedback has been received
			echo '<script type="text/javascript">';
			echo 'window.location.href="index.php?nav=Contact";';
			echo 'alert("Your feedback has been received")';
						
			echo '</script>';
			
			
			
		}
	}
?>

<html>
	<head>

		<style>
			.cont{
				width:400px;
				height:35px;
				
			}
			.mdiv{
				height:100%;
				width:70%;
				padding:20px;
				margin: auto;
				
			}
			.ldiv{
				float:left;
				width: 50%;
				
			}
			.rdiv{
				width:50%;
				float:right;
				padding-bottom:30px
			}
		</style>
	

	</head>	
	<body><br><br><br>
	<div class="mdiv">
		<div class="ldiv"><br><br><br>
			<table style="font-size:25px;height:400px; width:600px;">
				<tr><td colspan="2"><h2 style="text-shadow:1px 1px 2px red">KEEP IN TOUCH</h2></td></tr>
				<tr><td><b>Location: </b></td><td>Mesahill, Nilai<br>NegeriSembilan</td></tr>
				<tr><td><b>Operating Hours:</b></td><td>Monday to Friday<br>10am to 2pm<br>5pm to 9pm</td></tr>
				<tr><td><b>Email Us: </b></td><td>saloon@gmail.com<br>enquiry.saloon@gmail.com</td></tr>
			</table>
		</div>
	
	
		<div class="rdiv">
			<table style="background-color:rgba(1, 1, 1, 0.2); padding:10px; font-size:22px" align="center">
				<form method="post" onSubmit="return contCheck()" name="form2" action="contact.php">
				<tr><td align="center"><h2>Send us your Feedbacks</h2></td><br></tr>
				<tr><td>*Name: <br><input type="text" name="rname" class="cont" required><br><br><br></td></tr>
				<tr><td>*Email: <br><input type="email" name="remail" class="cont" required><br><br><br></td></tr>
				<tr><td>*Phone: <br><input type="number" name="rphone" class="cont" required><br><br><br></td></tr>
				<tr><td>*Remarks: <br><textarea rows="5" cols="54" name="rfeed" required></textarea><br><br></td></tr>
				<tr><td align="right"><input type="submit" name="remarks" value="Send" style="width:100px; height:30px; border-radius:7px; font-size:17px"></td></tr>		
				</form>
			</table> 
		<div>
	</div>
	
	</body>
</html>