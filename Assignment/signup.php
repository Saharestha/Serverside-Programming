<?
	include('conn.php');
	
	//if signup button is presses
	if(isset($_GET["Signup"]))
	{
		//get the signup details from the form
		$name=$_GET["name"];
		$email=$_GET["email"];
		$pass=$_GET["pass"];
		$pass1=$_GET["pass1"];
		
		if(!empty($name) && !empty($email) && !empty($pass) && !empty($pass1) )
		{
			//check of the confirmed password matches
			if($pass==$pass1)
			{
				$sel="select * from customer where cus_email='$email'";
				//echo $sel;
				$query=mysqli_query($conn, $sel);
				$rows=mysqli_fetch_row($query);
				//check if the email alredy exists
				
				//if the email doesn't exist register the user
				if($rows==0)
				{
					$ins="insert into customer(cus_name, cus_email, cus_pass) values('$name', '$email', '$pass')";
					echo $ins;
					$que=mysqli_query($conn, $ins);
					header("location:index.php?login=Log+In%2FSign+Up");
				}
				//alret that the email already exists
				else
				{	
						echo '<script type="text/javascript">';
						echo 'alert("Email exists")';  
						echo '</script>';
				}			
			}
			else
			{	
				echo '<script type="text/javascript">';
				echo 'alert("Password do not match")';  
				echo '</script>';
			}
		}
	}
?>

<html>
	<style>
		.sign{
			font-size:20px;
			padding:20px;
		}	
		#input{
			height:35px;
			width:300px;
			
		}
		.log{
			width:160px;
			border-radius:25px;			
		}
	</style>
	<body style="background-image:url(image/Background1.jpg);background-size:100% 100%">
	<h2 align="center">Sign Up</h2>
	<p align="center">Create your account by filling in!</p> 
		
		<!--FORM TO SIGN UP-->
			
		<table  align="center" style="background-color:rgba(255,0,0, 0.2)">
			<form method="GET" action="signup.php">
				<tr><td class="sign">*Name: </td><td class="sign"><input type=text name="name" id="input" value="<?if (!empty($name)) echo $name?>" required></td></tr>
				<tr><td class="sign">*Email: </td><td class="sign"><input type=email name="email" id="input" value="<?if (!empty($email)) echo $email?>" required></td></tr>
				<tr><td class="sign">*Password: </td><td class="sign"><input type=password name="pass" id="input" required></td></tr>
				<tr><td class="sign">*Confirm Password: </td><td class="sign"><input type=password name="pass1" id="input" required></td></tr>
				<tr><td align="top" style="padding:20px; color:red;font-size:13px">*Required Fields</td><td class="sign" align="right"><input type=submit name="Signup" value="Sign Up" class="log"></td></tr>
			
			</form>
			
		</table> 
		<p align="center">Go back to <a href="index.php?login=Log+In%2FSign+Up">Login Page</a></p>
	<body>


</html>