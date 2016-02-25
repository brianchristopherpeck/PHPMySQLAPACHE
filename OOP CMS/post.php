<?php

	include('db_fns.php');
	
	date_default_timezone_set('America/New_York');
			$unixTime = new DateTime();
			$date = $unixTime->getTimestamp();
			
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
	
		if (!get_magic_quotes_gpc()) 
		{
			$subject = addslashes($subject);
			$entry = addslashes($entry);
		}
		
		$name=$_POST['name'];
		$subject=$_POST['subject'];
		$entry=$_POST['entry'];
		
		include('db_fns.php');
			$query = "INSERT INTO forum ( user, subject, entry, timestamp ) VALUES ('".$name."', '".$subject."','".$entry."','".$timestamp."')";
			$result=mysqli_query($conn,$query) or DIE("Error inserting into the database" .mysqli_error());
			
			echo "Successfully updated with: " .$name. " , " .$subject. " " ;
			
					
	
	}
	
    $current_month=date("F");
	$current_date=date("d");
	$current_year=date("Y");
	$current_time=date("H:i");
	
	
	
?>

<form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">

    <p><strong><label for="month">Date:</label></strong> 
    
        <option value="<?php echo $current_month; ?>"><?php echo $current_month; ?></option><option value="<?php echo $current_date;?>"><?php echo $current_date;?>,</option><option value="<?php echo $current_year;?>"><?php echo $current_year;?></option>
    <strong><label for="time">Time:</label></strong> 
        <option value="<?php echo $current_time;?>"><?php echo $current_time;?></option></p>
    
    <p><strong><label for="name">User:</label></strong> <input type="text" name="name" id="name" size="40" ></p>
    <p><strong><label for="subject">Title:</label></strong> <input type="text" name="subject" id="subject" size="40" ></p >
    
    <p><textarea cols="80" rows="20" name="entry" id="entry" ></textarea></p>
    
    <p><input type="submit" name="submit" id="submit" value="Submit"></p>

</form>


  
	

