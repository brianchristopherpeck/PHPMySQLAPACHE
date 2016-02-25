<?php
    require_once('require.php');
	session_start();
	
	
	
	class changePage extends Page{
		public function main(){
?>
			<div id='main'>
<?php
			$this->display_change_form();
?>
			</div>
<?php
		}
	}
	
	$change=new changePage;
	$change->Display();
	
	if($_SESSION['valid_user'])
	{
		echo "Logged in as ".$_SESSION['valid_user'].".<br />";
	} else {
		echo "You are not logged in.";
	}
	
?>
