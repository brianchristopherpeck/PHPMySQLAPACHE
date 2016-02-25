<?PHP
ob_start();
	require_once('require.php');
	function login($username,$passwd){
		//check username and password with db
		//if yes return true
		//else throw exception
		//connect to db
		include('db_fns.php');
		if(!$conn){
			die .mysqli_error();
		} else {
			$username = $_POST['username'];
			$passwd = $_POST['passwd'];
			$username = stripslashes($username);
			$passwd = stripslashes($passwd);
			$username = mysqli_real_escape_string($conn, $username);
			$passwd = mysqli_real_escape_string($conn, $passwd);
	//check if username is unique
			$result = mysqli_query($conn,"SELECT username, passwd FROM usertable WHERE username='". $username ."' AND passwd=sha1( '".$passwd."') ")or die("Query failed.".mysqli_error());
			$row=mysqli_num_rows($result);
			if($row==1){
				session_start();
				$_SESSION['valid_user'] = $username;
				ob_end_clean();
				header("Location: member.php");
				exit;
			} else {
				die('Could not log you in. Username invalid.');
				do_html_URL('index.php','Login');
				exit();
			}
		}
	}
	login($username,$passwd);
?>