<?php
    require_once('require.php');
	
	session_start();
	
	$old_user=$_SESSION['valid_user'];
	
	unset($_SESSION['valid_user']);
	$result_dest=session_destroy();
	
	if(!empty($old_user)){
		if($result_dest){
			Header("Location:index.php");
			
		}else{
			Header('Location:member.php');
		}
	}
?>
