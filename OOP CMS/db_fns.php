<?php
ob_start();
	$hostname='localhost';
	$author='rippedandfit';
	$password='IL2eee@.B';
	$dbname='rippedandfit';
	$conn=mysqli_connect($hostname,$author,$password) OR DIE ('Unable to connect to database! Please try again later.');
	mysqli_select_db($conn,$dbname);
ob_end_clean();
?>
