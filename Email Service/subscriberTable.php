<?php
include("_include.php");
	// connect to db
	doDB();

	if(mysqli_connect_errno())
	{
		// if connection fails, stop script
		printf("Connect failed: %s\n",mysqil_connect_error());
		exit();
	} else {
		// otherwise get emails from subscribers 
		$sql = "SELECT * FROM subscribers";
		$result = mysqli_query($mysqli, $sql) 
			or die (mysqli_error($mysqli));

		echo "<h1>Subscribers List: </h1>";
		while($row = mysqli_fetch_array($result))
		{
			echo $row['id']. ".) " .$row['email']. "<br/>";
		}

		mysqli_free_result($result);
		mysqli_close($mysqli);
	}
?>