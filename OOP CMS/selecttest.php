<?php
     $hostname='rippedandfit.db.4222582.hostedresource.com';
	$author='rippedandfit';
	$password='IL2eee@.B';
	$dbname='rippedandfit';
	$connect=mysqli_connect($hostname,$author, $password) OR DIE ('Unable to connect to database! Please try again later.');
	mysqli_select_db($connect,$dbname);
	$username='averegejoe';
		//check if username is unique
		$query="SELECT username , passwd , email , id FROM usertable WHERE username='". $username."' ";
		$result = mysqli_query($connect,$query)or die("Query failed.");
		if(mysqli_num_rows($result)==0){
			echo "No user by that name in database";
			exit();
		}
		while($row = mysqli_fetch_array($result)) {
			$use = stripslashes($row['username']);		
			$id = ($row['id']);
			$pass= stripslashes($row['passwd']);
			$ema= stripslashes($row['email']);
			echo $id."<br />".$use."<br />" .$pass. "<br />" .$ema;
		}
		if($result){
			$_SESSION['valid_user']=$username;
		}else{
			return false;
		}
		if(isset($_SESSION['valid_user'])){
			echo "<br />Logged in as ".$_SESSION['valid_user'].".<br />";
		}else {
			//they are not logged in
			echo "<br />PROBLEM. You are not logged in.<br />";
			do_html_URL('index.php','Login');
			exit;
		}
		function do_html_URL($url,$name){
		//output url as link
?>
	<br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
		}
		if($_SESSION['valid_user']){
		
			do_html_URL("member.php","Go to member page!!!");
		}else{
			echo 'Your registration failed! - Please try again';
			}
?>
