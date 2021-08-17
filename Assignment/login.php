<?
	
	include('conn.php');
	if(isset($_POST["signup1"]))
		header("location:signup.php");
?>
<?
	//After you sign in
	if(isset($_POST["Signin"]))
	{
		$name1=$_POST["name1"];
		$email1=$_POST["email1"];
		$pass1=$_POST["pass1"];
		
		//check if all data are entered
		if(!empty($name1) && !empty($email1) && !empty($pass1))
		{
			$sel="select * from customer where cus_name='$name1' and cus_email='$email1' and cus_pass='$pass1'";
			$que=mysqli_query($conn, $sel);
			$row=mysqli_num_rows($que);
			$fet1=mysqli_fetch_row($que);
			//to check if the customer exists
			if($row==0)									//check if its employee if its not customer
			{
					$sel2="select * from employee where emp_name='$name1' and emp_email='$email1' and emp_pass='$pass1'";
					$que2=mysqli_query($conn, $sel2);
					$row2=mysqli_num_rows($que2);
					$fet=mysqli_fetch_row($que2);
					//if both employee and customer details do not match
					if($row2==0)
					{
						//alert about wrong account details		
						echo '<script type="text/javascript">';
						//direct then to sign up page
						echo 'window.location.href="signup.php";';
						echo 'alert("Account doesn\'t exist")';  
						echo '</script>';
					}
					else
					{
						//add employee id to session variable
						session_start();
						$_SESSION["id"]=$fet[0];
						//direct then to view appointment page for employees
						header("location:ViewApp.php");
					}
			}
			else
			{
				//add employee id to session variable
				session_start();
				$_SESSION["id"]=$fet1[0];
				//direct then to home page
				header("location:index.php");
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
	<body>
	<!--FORM FOR LOGING IN-->
	<h2 align="center">Sign In</h2>
	<p align="center">Fill up the table to sign in!</p> 
		<table style="background-color:rgba(1,1,1, 0.2);" align="center">
			<form method="post" action="login.php">
			<tr><td class="sign">*Name: </td><td class="sign"><input type=text name="name1" id="input" required></td></tr>
			<tr><td class="sign">*Email: </td><td class="sign"><input type=email name="email1" id="input" required></td></tr>
			<tr><td class="sign">*Password: </td><td class="sign"><input type=password name="pass1" id="input" required></td></tr>
			<tr><td align="top" style="padding:20px; color:red;font-size:13px">*Required Fields</td><td class="sign" align="right">
			<input type='submit' name="Signin" value="Sign In" class="log"></td></tr></form>
			
		
		</table> 
		<!--GO TO SiGN UP PAGE IF YOU DONT HAVE AN ACCOUNT-->
		<form method="post" action="signup.php"><p align="center">Don't have an account <input type ="submit" name="signup1" value="Sign Up"></form></p>
	<body>
</html>