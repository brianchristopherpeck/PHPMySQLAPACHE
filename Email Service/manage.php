<?php 
include('_include.php');
if(!$_POST) 
{
	$display_block = <<< END_OF_BLOCK
	<form method="POST" action="manage.php">
		<p>
			<label for="email"> Your E-mail Address: </label> <br/>
			<input type="email" id="email" name="email" 
				size="40" maxlength="150" />
		</p>

		<fieldset>
			<legend> Action: </legend> <br/>
			<input type="radio" id="action_sub" name="action"
				value="sub" checked="checked" />
			<label for="action_sub"> subscribe </label> <br/>
			<input type="radio" id="action_unsub" name="action"
				value="unsub" />
			<label for="action_unsub">
				unsubscribe
			</label>
		</fieldset>

		<button type="submit" name="submit" value="submit">
			Submit
		</button>
	</form>
END_OF_BLOCK;
} else if (($_POST) && ($_POST['action'] == 'sub')) {
	// validate email
	if ($_POST['email'] == '') 
	{
		echo "Your email is empty at point 1";
		// header("Location: manage.php");
		exit;
	} else {
		//attempt to connect to DB
		doDB();

		// check for email in list
		emailChecker($_POST['email']);

		// get results rows
		if (mysqli_num_rows($check_res) < 1) 
		{
			// Email does not exist
			mysqli_free_result($check_res);

			// add record of new email
			$add_sql = "INSERT INTO subscribers (email)
				VALUES ('".$safe_email."')";

			$add_res = mysqli_query($mysqli, $add_sql) or 
				die (mysqli_error($mysqli));
			$display_block = "<p> Thanks for singing up!</p>";

			// disconnect
			mysqli_close($mysqli);
		} else {
			$display_block = "<p> You're aleady subscribed!</p>";
		}

	}
} else if (($_POST) && ($_POST['action'] == 'unsub')) {
	// trying to unsubscribe
	if ($_POST['email'] == '') 
	{
		echo "your email is empty at point 2";
		// header("Location: manage.php");
		exit;
	} else {
		// connect to db
		doDB();

		// check email
		emailChecker($_POST['email']);

		// get results
		if (mysqli_Num_rows($check_res) < 1 )
		{
			mysqli_free_result($check_res);

			// failure message
			$display_block = "<p>Couldn't find your address!</p>
				<p>No action taken.</p>";
		} else {
			// get result id from DB
			while ($row = mysqli_fetch_array($check_res))
			{
				$id = $row['id'];
			}

			$del_sql = "DELETE FROM subscribers WHERE 
				id = '".$id."'";
			$del_res = mysqli_query($mysqli, $del_sql) or
				die (mysqli_error($mysql));
			$display_block = "<p>You're unsubscribed</p>";
		}

		mysql_close($mysqli);
	}
}
?>
<!DOCTYPE html>
<html>
<head>
<title>
		Subscribe/Unsubscribe To Mailing List
</title>
</head>	
<body>
	<h1>
		Subscribe/Unscribe to a Mailing List
	</h1>
<?php 
	echo "$display_block"; 
?>
</body>
</html>