<?php
		require_once('require.php');
		session_start();
		
	class memberPage extends Page{
			public function left() {
?>
<div id='left'>	
		<p><a id="index" title="index" class="active" href="member.php" alt="member">Member</a>
<?php
		include('db_fns.php');
		$query = "SELECT id, subject FROM forum ORDER BY timestamp";
		$result =mysqli_query($conn,$query); 
		while($row = mysqli_fetch_array($result)) {
			$subject = stripslashes($row['subject']);		
			$id = ($row['id']);
?>
	<p><a id="journal.php?id=<?php echo $id ?>" title="journal.php?id=<?php echo $id ?>" class="inactive" href="journal.php?id=<?php echo $id ?>" alt="<?php echo $subject?>"> <?php echo $subject;?></a></p>
<?php
	}
?>
</div>
<?php
			}
		function main() {

			if(!$_SESSION['valid_user']){
			//they are not logged in
			echo "<div id = 'main'><h3>You must be a member to comment on an article</h1></div>";
			} else {
?>
	<div id='main'>	
	<p>WELCOME!!! Select an article.</p>
    </div>
<?php
			}
		}
	}
	$member=new memberPage;
	$member->Display();
	
	ob_end_clean();
?>