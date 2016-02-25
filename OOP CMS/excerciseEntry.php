<?php
    require_once('require.php');
		session_start();

		

		
		
		if(!isset($_SESSION['valid_user'])){
			echo 'You must be logged in to view this page';
			exit;
		}
		
		
		
		class excerciseEntry extends Page {
			
		public function main(){
?>
<div id='main'>
<?php

$this->excercise_form();
?>
</div>
<?php
	}
			
}
	$excerciseentry= new excerciseEntry;
	$excerciseentry->Display();
	
	if($_SESSION['valid_user']){
		echo "Logged in as ".$_SESSION['valid_user'].".<br />";
		echo $_SESSION['valid_user']. "<br />";
		}else{
			echo "You are not logged in";
		}
		
	if($_SESSION['valid_user']==$admin){
			echo "<br />Welcome administrator!!!";
		}else {
			die('You must be the administrator to view this page!!!');	
		}
		
?>
