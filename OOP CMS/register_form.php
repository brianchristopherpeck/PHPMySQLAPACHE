<?php
    require_once('require.php');
	session_start();
	
	
	
	class registerPage extends Page{
		public function main(){
?>
<div id='main'>
<?php
$this->display_registration_form();
?>
</div>
<?php
	}
	}
	
	$register=new registerPage;
	$register->Display();
	
	if($_SESSION['valid_user']){
		echo "Logged in as ".$_SESSION['valid_user'].".<br />";
	}else{
		echo "You are not logged in.";
	}
	
?>
