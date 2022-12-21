<?php  

	session_start();
	if (!isset($_SESSION['user'])) 
	{
		header("location:../general/login.php?message=Invalid Access Please Login First");
	}
	

?>