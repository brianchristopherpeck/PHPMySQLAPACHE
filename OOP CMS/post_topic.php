<?php

	function post_topic()
	{

		if(isset($_POST['submit']))
		{
			$month = htmlspecialchars(strip_tags($_POST['month']));
			$date = htmlspecialchars(strip_tags($_POST['date']));
			$year = htmlspecialchars(strip_tags($_POST['year']));
			$time = htmlspecialchars(strip_tags($_POST['time']));
			$title = htmlspecialchars(strip_tags($_POST['title']));
			$entry = $_POST['entry'];
	
			$timestamp = strtotime($month . " " . $date . " " . $year . " " . $time);
		
			$entry = nl2br($entry);
		
			if (!get_magic_quotes_gpc()) 
			{
				$title = addslashes($title);
				$entry = addslashes($entry);
			}
			
			include('db_fns.php');
			$query= "INSERT INTO forum (entry, timestamp, user) VALUES ('$entry','$timestamp','$user')";
			$result=mysqli_query($conn,$query) or print("Can't insert into table<br />" . $query . "<br />" . mysqli_error());
				
	
		}
?>
<?php
		$current_month=date("F");
		$current_date=date("d");
		$current_year=date("Y");
		$current_time=date("H:i");
		
		$entry=$_POST['entry'];
		$timestamp=$_POST[$current_time + $current_date + $current_year + $current_time ];
		$user=$_POST['user'];
		
	
?>

        <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
        
        <p><strong><label for="month">Date:</label></strong> 
        
            <option value="<?php echo $current_month; ?>"><?php echo $current_month; ?></option>
            <option value="<?php echo $current_date;?>"><?php echo $current_date;?>,</option>
            <option value="<?php echo $current_year;?>"><?php echo $current_year;?></option>
        <strong><label for="time">Time:</label></strong> 
            <option value="<?php echo $current_time;?>"><?php echo $current_time;?></option></p>
        
        <p><strong><label for='user'>User:</label></strong> <input type="text" name="user" size="40" /></p>
        <p><strong><label for="title">Title:</label></strong> <input type="text" name="title" size="40" /></p >
        
        <p><textarea cols="80" rows="20" name="entry" id="entry"></textarea></p>
        
        <p><input type="submit" name="submit" id="submit" value="Submit"></p>
        
        </form>
<?php
	}
?>