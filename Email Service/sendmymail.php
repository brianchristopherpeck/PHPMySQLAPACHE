<?php
include("_include.php");
	if(!$_POST)
	{
	// Haven't submitted the form so display
		$display_block = <<< END_OF_BLOCK
		<form method="POST" action="sendmymail.php" >
			<p>
				<label for="subject">Subject:</label><br/>
				<input type="text" id="subject" name="subject" size="40" />
			</p>
			<p>
				<label for="message">Message:</label><br/>
				<textarea id="message" name="message" cols="50" 
				rows="10"> </textarea>
			</p>
			<button type="submit" name="submit" value="submit">
				Submit
			</button>
		</form>
END_OF_BLOCK;
	} else if ($_POST) {
		if (($_POST['subject'] == "") || ($_POST['message'] == ""))
		{
			header("Location: sendmymail.php");
			exit;
		}
	

	// connect to DB
		doDB();

		if(mysqli_connect_errno())
		{
			// if connection fails, stop script
			printf("Connect failed: %s\n",mysqil_connect_error());
			exit();
		} else {
			// otherwise get emails from subscribers 
			$sql = "SELECT email FROM subscribers";
			$result = mysqli_query($mysqli, $sql) or die (mysqli_error($mysqli));

			// create a mail header
			$mailHeaders = "From: happybearcoding.com";

			//loop through results and send email
			while($row = mysqli_fetch_array($result))
			{
				set_time_limit(0);
				$email = $row['email'];
				mail("$email", stripslashes($_POST['subject']), 
					stripslashes($_POST['message']), $mailHeaders);
				$display_block .= "newsletter sent to: ".$email."<br/>";
			}	
			mysqli_free_result($result);
			mysqli_close($mysqli);
		}
	}
?>
<!DOCTYPE html>
<html>
<head>
<title>Send A Newsletter</title>
</head>
<body>
<h1>Send A Newsletter</h1>
<?php echo $display_block; ?>
</body>
</html>