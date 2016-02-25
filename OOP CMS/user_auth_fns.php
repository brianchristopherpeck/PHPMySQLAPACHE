<?php
ob_start();
	function register($username, $email, $passwd, $date){
		include("db_fns.php");
			$username= $_POST['username'];
			$passwd= $_POST['passwd'];
			$passwd2 = $_POST['passwd2'];
			$email=$_POST['email'];
			$month = htmlspecialchars(strip_tags($_POST['month']));
    	$date1 = htmlspecialchars(strip_tags($_POST['date']));
    	$year = htmlspecialchars(strip_tags($_POST['year']));
    	$time = htmlspecialchars(strip_tags($_POST['time']));
		$date = strtotime($month . " " . $date1 . " " . $year . " " . $time);
		if(empty($username)){
			die('Please enter your username!');
		}
		if(empty($passwd)){
			die('Please enter your password!');
		}
		if(empty($passwd2)){
			die('Please enter your password confirmation!');
		}
		if(empty($email)){
			die('Please enter your email!');
		}
			$user_check=mysqli_query($conn,"SELECT username FROM usertable WHERE username = '".$username."' ");
			$do_user_check=mysqli_num_rows($user_check);
			$email_check=mysqli_query($conn, "SELECT email FROM usertable WHERE email = '".$email."' ");
			$do_email_check=mysqli_num_rows($email_check);
		if($do_user_check>0) {
			die ("Username already in use!");
		}
		if($do_email_check>0) {
			die ("Email already in use!");
		}
		if($passwd != $passwd2) {
			die ("Passwords don't match!");
		}
	$insert=mysqli_query($conn,"INSERT INTO usertable ( id, username, passwd, email, date) VALUES ('NULL' , '".$username."', sha1('".$passwd."'), '".$email."', '".$date."') ");
		if(!$insert){
			die("There's a little problem..." .mysqli_error());
		}
		header( "refresh:3;url=index.php" );
	echo $username. "</br>You are now registered. Thank you!</br>
	 You'll be redirected in about 3 seconds... If not, click <a href=index.php>LOGIN</a>";
	}
	function check_valid_user(){
		//see if somebody is logged in and notify them if not
		if(isset($_SESSION['valid_user'])){
			return true;
		}else {
			//they are not logged in
			echo "PROBLEM. You are not logged in.<br />";
			do_html_URL('index.php','Login');
			exit;
		}
	}
	function do_html_URL($url,$name){
		//output url as link
?>
	<br /><a href="<?php echo $url;?>"><?php echo $name;?></a><br />
<?php
	}
	function change_password($username, $old_password, $new_password){
		//change password for username/old_password to new_password
		//return true or false
		//if old password is right, change password to new password and return true
		//else throw exception
		include('db_fns.php');
		$query="UPDATE usertable SET passwd = sha1('".$new_password."') WHERE username='".$username."'";
		$result=mysqli_query($conn,$query);
		if(!$result){
			throw new Exception('Password could not be changed.');
		}else{
			//password changed successfully
		header('refresh:1;url=index.php');
		echo "Password successfully changed! Please login.";
		}
	}
	function filled_out($form_vars){
		foreach($form_vars as $key=>$value){
			if(!isset($key)||($value=="")){
				return false;
			}
		}
		return true;
	}
	function valid_email($address){
		if(ereg("^[a-zA-Z0-9_\.\-]+@[a-zA-Z0-9\-]+\.[a-zA-Z0-9\-\.]+$",$address)){
			return true;
		}else{
			return false;
		}
	}
	function generatePassword($length=9, $strength=0){
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength & 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength & 2) {
			$vowels .= "AEUY";
		}
		if ($strength & 4) {
			$consonants .= '23456789';
		}
		if ($strength & 8) {
			$consonants .= '@#$%';
		}
 
			$new_password = '';
			$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$new_password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$new_password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $new_password;
	}
	function notify_password($username, $new_password){
		$from= "From: support@rippedandfit.com\r\n";
		$mesg= "Your rippedandfit password has been changed to" .$new_password."\r\n"."Please change it on next log in!";
		if(mail($email,'rippedandfit login information', $mesg, $from)){
			return true;
		}else{
			do_html_URL("index.php", "Homepage");
			die('Could not send mail');
			}
		echo 'Your new password has been emailed to you - please change it on next log in!';
		do_html_URL("index.php","Homepage");
	}
	ob_end_clean();
?>