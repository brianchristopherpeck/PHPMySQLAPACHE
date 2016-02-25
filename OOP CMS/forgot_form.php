<?php
    
    require_once('require.php');
		session_start();

		

		if($_SESSION['valid_user']){
		echo "Logged in as ".$_SESSION['valid_user'].".<br />";
		}else{
			echo "You are not logged in";
		}
		
		class termsPage extends Page
	{
		public function Display()
		{
			echo "<html>\n<head>\n";
			$this->DisplayDocHeader();
			$this-> DisplayTitle();
			$this-> DisplayKeywords();
			$this-> DisplayDescription();
			$this-> DisplayStyles();
			$this-> DisplayGoogle();
			echo "</head>\n<body>\n";
			$this->header1($this->buttons);
			$this->left();
			$this->main();
			$this->right();
			$this -> footer();
			echo "</body>\n</html>\n";
		}

	function main()
	{
?>
<div id='main'>
<?php
$this->forgot_form();
?>
</div>
<?php
	}
function left() {
?>
<div id='left'>
<?php	
if($_SESSION['valid_user']){
	echo '<p><a id="index" title="index" class="inactive" href="member.php" alt="HOME">Member</a>';
	}else{
		echo '<p><a id="index" title="index" class="inactive" href="index.php" alt="HOME">Home</a>';
	}
	

		global $id;
		include('db_fns.php');
		$query = "SELECT id, subject FROM forum ORDER BY timestamp";
		$result = mysqli_query($conn,$query); 
		while($row = mysqli_fetch_array($result)) {
			$subject = stripslashes($row['subject']);		
			$id2 = ($row['id']);
?>			
	<p><a id="journal.php?id=<?php echo $id2 ?>" alt="<?php echo $subject ?>"title="journal.php?id=<?php echo $id2 ?>" <?php echo  ($id2 ==$id) ? ' class="active"' : ''; ?>" href="journal.php?id=<?php echo $id2 ?>"> <?php echo $subject ?></a></p>
	
<?php
	}
?>
</div>
<?php	
}		
		
	}
	$terms = new termsPage;
	$terms->Display();
?>


