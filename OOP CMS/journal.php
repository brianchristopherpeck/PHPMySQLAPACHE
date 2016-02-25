<?php
    	require_once('require.php');
		session_start();
		include('db_fns.php');
		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
		{
    		die("Invalid ID specified.");
		}

		$id = (int)$_GET['id'];
		

		$query = "SELECT * FROM forum WHERE id='".$id."' LIMIT 1";
		$result = mysqli_query($conn,$query); 
		while($row = mysqli_fetch_array($result)) 
		{
			$id=$row['id'];
			$subject1=$row['subject'];

		}
		
		date_default_timezone_set('America/New_York');
		
	class journalPage extends Page
	{
		public function DisplayKeywords()
		{
			if (!isset($_GET['id']) || !is_numeric($_GET['id']))
			{
   				die("Invalid ID specified.");
			}
			include('db_fns.php');
			$id = (int)$_GET['id'];
			$query = "SELECT * FROM forum WHERE id='".$id."' LIMIT 1";
			$result = mysqli_query($conn,$query); 
				while($row = mysqli_fetch_array($result)) 
				{
					$id=$row['id'];
					$subject1=$row['subject'];
						echo "<meta name=\"keywords\"
						content=\""  .$subject1. "\"/>";
				}
		}
		
		public function DisplayDescription()
		{
				
				if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
				{
    				die("Invalid ID specified.");
				}
				include('db_fns.php');
				$id = (int)$_GET['id'];
		
				$query = "SELECT * FROM forum WHERE id='".$id."' LIMIT 1";
					$result = mysqli_query($conn,$query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$subject1=$row['subject'];
						echo "<meta name=\"description\"
						content=\"".$subject1."\"/>";
					}
		}
		
		
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
			$this->main();
			$this->left();
			$this -> footer();
			echo "</body>\n</html>\n";
		}
		
		function main()
		{
?>
			<div id='main'>
<?php
			if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
			{
    			die("Invalid ID specified.");
			}
			
			include('db_fns.php');
			$id = (int)$_GET['id'];

			$query = "SELECT * FROM forum where id='$id' LIMIT 1";
			$result = mysqli_query($conn,$query); 
			while($row = mysqli_fetch_array($result)) 
			{
				echo "<div id='post'>
				<p><h1>".($row['subject'])."</h1></p>
				<p>".($row['entry'])."</p>
				<p>Posted by:  ".($row['user'])."</p>
				<p>Date posted: ".date("l F d Y", $row['timestamp'])."</p>
				</div>";	
			}
			
			include('db_fns.php');
			$query = "SELECT * FROM forum_comment
			where entry = '$id' ";
			$result= mysqli_query($conn,$query);
			while($row = mysqli_fetch_array($result)) 
			{
?>
				<div id='comment1'>
<?php
					echo"
					<p>".$row['comment']."</p>
					<p>Posted by: " .$row['name']."</p>
					<p>Date: ".date("l F d Y", $row['timestamp']);"</p>";
?>
				</div>
<?php
			}
	

		


?>
				<div id='form'>
	
					<form method="post" action="process_comment.php">
					<br />
					<strong>POST A COMMENT!!!</strong><br /><br />
						<input type="hidden" name="entry" id="entry" value="<?php echo $id; ?>" />
                        <input type="hidden" name="timestamp" id="timestamp" value="<?php $unixTime = new DateTime(); $date = $unixTime->getTimestamp();echo $date; ?>" />
                        <strong><label for="name">NAME: <?php global $_SESSION; if($_SESSION['valid_user']){echo $_SESSION['valid_user'];}else{echo'You are not logged in';}?></label> </strong><br />
                        <input type="hidden" name="name" id="name" size="25" value="<?php echo $_SESSION['valid_user'];?>"/><br />
                        <strong><label for="comment">COMMENT:</label></strong><br />
                        <textarea name="comment" id="comment" cols="50" rows="20" ></textarea>
                        <br />
                        <input type="submit" name="submit_comment" id="submit_comment" value="ADD COMMENT" />
                    </form>
				</div>
			</div>
<?php
	}
		function left() 
		{
?>
			<div id='left'>
<?php	
			if($_SESSION['valid_user'])
			{
				echo '<p><a id="index" title="index" class="inactive" href="member.php" alt="HOME">Member</a>';
			}else{
				echo '<p><a id="index" title="index" class="inactive" href="index.php" alt="HOME">Home</a>';
			}
	
			include('db_fns.php');
			global $id;
			$query = "SELECT id, subject FROM forum ORDER BY timestamp";
			$result = mysqli_query($conn,$query); 
			while($row = mysqli_fetch_array($result)) 
			{
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
	
	$journal = new journalPage;
	$journal->Display();
	
	
		
?>
		
		


