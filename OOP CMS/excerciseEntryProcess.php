<?php
	require_once('require.php');

    echo $SESSION['valid_user'];
		
		$subject=$_POST['subject'];
		$entry1=$_POST['entry1'];
		$photo1=$_POST['photo1'];
		$entry2=$_POST['entry2'];
		$photo2=$_POST['photo2'];
		$scenery=$_POST['scenery'];
			
	include('db_fns.php');
	$query  = "INSERT INTO exportrait VALUES('null', '".$subject."', '".$entry1."' , '".$photo1."', '".$entry2."', '".$photo2."', '".$scenery."')";
	$result = mysqli_query($conn,$query);
	
	if(!$result){
		echo 'Can\'t register article.';
		exit;
	}else{
		echo 'Article entered!!!';
		return true;
	}
?>
