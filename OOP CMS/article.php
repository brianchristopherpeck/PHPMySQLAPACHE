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
				while($row = mysqli_fetch_array($result)) 
				{
					$subject = stripslashes($row['subject']);		
					$id = ($row['id']);
?>
				<p><a id="journal.php?id=<?php echo $id ?>" title="journal.php?id=<?php echo $id ?>" class="inactive" href="journal.php?id=<?php 				echo $id ?>" alt="<?php echo $subject?>"> <?php echo $subject;?></a></p>
<?php
				}
?>
				</div>
<?php
			}
			
			function main() 
			{

				if(!$_SESSION['valid_user'])
				{
					//they are not logged in
					echo "<div id = 'main'><h3>You must be a member to comment on an article</h1></div>";
				} else {
?>
				<div id='main'>	
				<p>WELCOME!!! Post a new topic or select one on the left.</p>
<?php
					if(!isset($_SESSION['valid_user']))
					{
						echo "You must be logged in to submit articles- Go back and log in";
					}
					
					if(isset($_POST['submit']))
					{
						$month = htmlspecialchars(strip_tags($_POST['month']));
						$date = htmlspecialchars(strip_tags($_POST['date']));
						$year = htmlspecialchars(strip_tags($_POST['year']));
						$time = htmlspecialchars(strip_tags($_POST['time']));
						$subject = htmlspecialchars(strip_tags($_POST['subject']));
						$entry = $_POST['entry'];	
						$timestamp = strtotime($month . " " . $date . " " . $year . " " . $time);
						$entry = nl2br($entry);
						include('db_fns.php');
						$query = "INSERT INTO forum ( user, subject, entry, timestamp ) VALUES ('".$_SESSION['valid_user']."', '".$subject."','".$entry."','".$timestamp."')";
						$result=mysqli_query($conn,$query) or DIE("Error inserting into the database" .mysql_error());
						echo "<h2>Successfully entered!!!</h2> " ;
					}
					$current_month=date("F");
					$current_date=date("d");
					$current_year=date("Y");
					$current_time=date("h:i:s:a");
?>
                    <div id='form'>
                    <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <p><strong><label for="month">Date:</label></strong> 
                            <option value="<?php echo $current_month; ?>""<?php echo $current_date;?>""<?php echo $current_year;?>">"<?php echo $current_month; ?>""<?php echo $current_date;?>""<?php echo $current_year;?>"</option>
                            <option value="<?php echo $current_date;?>"><?php echo $current_date;?></option>
                            <option value="<?php echo $current_year;?>"><?php echo $current_year;?></option>
                        <strong><label for="time">Time:</label></strong> 
                            <option value="<?php echo $current_time;?>"><?php echo $current_time;?></option></p>
                        <p><strong><label for="user">User: <?php global $_SESSION; if($_SESSION['valid_user']){echo $_SESSION['valid_user'];}else{echo 'You are not logged in';}?></label></strong>
                            <input type="hidden" name="name" id="name" size="40" value="<?php echo $_SESSION['valid_user'];?>"></p>
                        <p><strong><label for="subject">Title:</label></strong> <input type="text" name="subject" id="subject" size="40" ></p >
                        <p><textarea cols="65" rows="20" name="entry" id="entry" ></textarea></p>
                        <p><input type="submit" name="submit" id="submit" value="Submit"></p>
                    </form>
                    </div>
                    </div>
<?php	
				}
			}	
		}
	$member=new memberPage;
	$member->Display();
	
	if($_SESSION['valid_user'])
	{
		echo "Logged in as ".$_SESSION['valid_user'].".<br />";
	 }else {
		echo "You are not logged in.";
	}
	ob_end_clean();
?>