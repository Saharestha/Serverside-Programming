<html>
	<body>
		
		<table height="10%" width="100%" style="border-collapse: collapse;">
			<!--To include the header-->
			<tr><td align="center" bgcolor="black" style="padding-top:15px"><? include("header.php")?></td></tr>
			<!--To include the navigation bar-->
			<tr><td align="center" bgcolor="#d27979"><br><? include("navigation.php")?></td></tr>
			</table>
		
			<table height="90%" width="100%" style="background-image:url(image/Background1.jpg);background-size:100% 100%">
			<tr><td valign="top">
			<?
				//to show the page according to the navigation bar button pressed
				if(isset($_GET['nav'])){
					switch($_GET['nav']){	
						case 'Make Appointment':
							include('appointment.php');
							break;
						case 'Contact':
							include('contact.php');
							break;
						case 'Main':
							include('mainPage.php');
							break;
						case 'Services':
							include('services.php');
							break;
						default:
							include('mainPage.php');
							break;
					}
				}
				else if(isset($_GET['appoint']))
				{
					if($_GET['appoint']=='Make Your Appointment')
						include('appointment.php');
				}
				else if(isset($_GET['login']))
				{
					include('login.php');
					
				}
				
				
				else
					include('mainPage.php');
				
			?>
			</td></tr>
		</table>
		<!--To include the footer-->
		<table height="10%" width="100%" bgcolor="black">
			<tr><td><? include("footer.html");?></td></tr>
		</table>
	</body>
</html>