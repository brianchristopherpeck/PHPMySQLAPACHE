<?php
    require('require.php');
	session_start();
	
	if(!($_SESSION['valid_user'])){
		echo 'You must be logged in to submit comments!!! - Please log in first!';
		do_html_URL('index.php','Login');
		exit;
	}
	
	
	if (isset($_POST['submit_comment'])) {

    if (empty($_POST['name']) || empty($_POST['comment'])) {
        die("You have forgotten to fill in one of the required fields! Please make sure you submit a name and comment.");
    }

    $entry = htmlspecialchars(strip_tags($_POST['entry']));
    $timestamp = htmlspecialchars(strip_tags($_POST['timestamp']));
    $name = htmlspecialchars(strip_tags($_POST['name']));
    
    $comment = htmlspecialchars(strip_tags($_POST['comment']));
    $comment = nl2br($comment);

    if (!get_magic_quotes_gpc()) {
        $name = addslashes($name);
        $comment = addslashes($comment);
    }

    

  include('db_fns.php');
    $query= "INSERT INTO forum_comment (entry, timestamp, name, comment) VALUES ('".$entry."','".$timestamp."','".$name."','".$comment."')";
	$result=mysqli_query($conn,$query) or print("Can't insert into table<br />" . $query . "<br />" . mysqli_error());
    header("Location: journal.php?id=" . $entry);
}
else {
    die("Error: you cannot access this page directly.");
}
?>

