
<style>
	.img {
		position: relative;
		font-family: Arial;
	}

	.txt {
		position: absolute;
		top: 50%;
		left: 40%;
		color: black;
		width: 200px;
		height: 100px;
	}
	.appoint{
		position:absolute;
		left:0px;
		height:40px;
		width:210px;
		background-color:#994d00;
		font-size:15px
		
	}
	
</style>

<!--Contets of main page-->
<div class="img"><img src="image/hairPic1.jpg" alt="hair" width="100%">
	<div class="txt"><font size="20px">Welcome</font><br><br>
		<form method="get" action="index.php">
			<!--TO go to make appointment page-->
			<input type="submit" name="appoint" value="Make Your Appointment" class="appoint"></form>
	</div>
</div>