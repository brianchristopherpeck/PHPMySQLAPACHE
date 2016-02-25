<?php
    require_once('require.php');
	
	$username=$_POST['username'];
	$old_password=$_POST['old_password'];
	$new_password=$_POST['new_password'];
	$new_password2=$_POST['new_password2'];
	
	session_start();
	
	if(!filled_out($_POST))
	{
		die('You have not filled out the form correctly - Go back and try again!');
	}
	
	if($new_password!=$new_password2)
	{
		die('Both new passwords are not equal to each other! - Go back and try again!');
	}
	
	if((strlen($new_password)<6)||(strlen($new_password)>16))
	{
		die('You password must be between six and sixteen characters. - Go backand try again!');
	}
	
	change_password($username, $old_password, $new_password);
?>
