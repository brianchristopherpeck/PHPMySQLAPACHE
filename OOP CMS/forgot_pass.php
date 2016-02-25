<?php
    require_once('require.php');
	$new_password=generatePassword($length=9, $strength=0);
	
	if($new_password==false){
		die('Could not generate new password');
	}
	
	
	$username=$_POST['username'];
	$email=$_POST['email'];

	if(!filled_out($_POST)){
		die('You must enter your username and email!!!- Try again');
		exit;
	}
	
	//Check to make sure user exists and knows both username and password
	include('db_fns.php');
	$query=("UPDATE usertable SET passwd=sha1('".$new_password."') WHERE username ='".$username."' AND email='".$email."'")or die .mysqli_error();
	$result = mysqli_query($conn, $query);
	
	header("refresh:15;url=index.php");
	echo $username ."<br />";
	echo $email ."<br />";
	echo "Your new password is " .$new_password. "<br />";
	if(!$result){
		die('Did not work');
		exit;
	}else if($result){
		echo "You data was updated with " .$new_password;
		echo "Your page will be refreshed in 15 seconds!";
	}
	
	notify_password($username,$new_password);
	
	
	
?>
