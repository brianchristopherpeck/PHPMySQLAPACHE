<?php
// emailService include functions //
function doDB()
{
	global $mysqli;

	// connect to the server and select database
	$mysqli = mysqli_connect("localhost", "root", "@wesome", "emailService");

	// connection error
	if(mysqli_connect_errno())
	{
		printf("Connection failed: %s\n", mysqli_connect_error());
		exit();
	}
}

function emailChecker($email) 
{
	global $mysqli, $safe_email, $check_res;

	// check that email doesn't already exist
	$safe_email = mysqli_real_escape_string($mysqli, $email);
	$check_sql = "SELECT id FROM subscribers WHERE email = '".$safe_email."'";
	$check_res = mysqli_query($mysqli, $check_sql) or die(mysqli_error($mysqli));
}
?>