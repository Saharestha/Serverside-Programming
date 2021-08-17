<?
	//to include conn page
	include('conn.php');
	
	$id=$_GET['id'];
	
	
	//to delete the completed appointments
	$del="delete from appointment where app_date<CURDATE() and emp_id=$id";
	mysqli_query($conn, $del);
	//direct the employees back to page to view appointments
	header("location:ViewApp.php?");	
?>