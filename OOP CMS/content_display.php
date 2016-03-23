<?php
ob_start();
	class PAGE 
	{
	//class PAGE's attributes
		public $title = "Ripped and Fit";
		public $keywords = "Ripped and Fit, Ripped and Fit - Official Homepage, fitness, fitness blog, Fitness manual, learn about fitness, 
						discuss fitness, excercise, excercises ";
		public $description = "Online fitness manual so you can learn about fitness and guarantee your personal success. Includes 
						a public online forum so you can get the help you need from your peers in the fitness community.";
						 
		public $buttons = array("Excercise Manual"=>"archivemain.php",
							"Fitness Facts"=>"fitnessfacts.php",
							"Member Page"=>"member.php",
							"Terms of Service"=>"termofservice.php");
	
		public function __set($name, $value)
		{
			$this->$name = $value;
		}
		
		public function Display()
		{
			echo "<html>\n<head>\n";
			$this->DisplayDocHeader();
			$this-> DisplayTitle();
			$this-> DisplayKeywords();
			$this-> DisplayDescription();
			$this-> DisplayStyles();
			$this-> DisplayGoogle();
			echo "</head>\n<body>\n";
			$this->header1($this->buttons);
			$this->main();
			$this->left();
			$this ->footer();
			echo "</body>\n</html>\n";
		}		
		
		public function DisplayDocHeader()
		{
?>
			<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
        "http://www.w3.org/TR/html4/loose.dtd">
<?php
		}
		public function DisplayTitle()
		{
			echo "<title>".$this->title."</title>";
		}
		public function DisplayKeywords()
		{
			echo "<meta name=\"keywords\"
				content=\"".$this->keywords."\"/>";
		}
		public function DisplayDescription()
		{
			echo "<meta name=\"description\"
				content=\"".$this->description."\"/>";
		}
		public function DisplayStyles()
		{
?>
			<link rel='stylesheet' type='text/css' href='style.css'/>
    		<link rel='stylesheet' type='text/css' media='only screen and (min-width:501px) and (max-width:1150px)' href='style_medium.css'/>
    		<link rel='stylesheet' type='text/css' media='only screen and (min-width:50px) and (max-width:500px)' href='style_small.css'/>
    		<meta name="viewport" content="width=device-width, maximum-scale=1.0, minumum-scale=1.0, initial-scale=1.0"/>
<?php
		}
		public function DisplayGoogle()
		{
?>
			<script type="text/javascript">
				var _gaq = _gaq || [];
 			 	_gaq.push(['_setAccount', 'UA-16908498-1']);
 			 	_gaq.push(['_trackPageview']);
				(function() {
    				var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
   					ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    				var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  				})();
			</script>
<?php
		}
		
		public function main()
		{
?>
			<div id='main'>
				<p><h1>Ripped & Fit</h1></p>
				<p><h3> Welcome to Ripped and Fit.com!!! Use the online fitness manual so you can learn about fitness and guarantee your 
				personal success! Use the public online forum so you can get the help you need from your peers in the fitness 
				community!</h3></p>
<?php
				$this->login_form();
?>
			</div>
<?php
		}
		
		public function left() 
		{
?>
			<div id='left'>	
	
<?php
			if(!$_SESSION['valid_user'])
			{
?>
				<p><a id="index" title="index" class="active" href="index.php" alt="HOME">Home</a></p>
<?php
			}else{
?>
				<p><a id="Member" title="Member" class="active" href="member.php" alt="Member">Member</a></p>
<?php
			}
			ob_start();
				include('db_fns.php');
			ob_end_clean();
			$query = "SELECT id, subject FROM forum ORDER BY timestamp";
			$result = mysqli_query($conn, $query); 
			while($row = mysqli_fetch_array($result))
			{
				$subject = stripslashes($row['subject']);		
				$id = ($row['id']);
?>
				<p><a id="journal.php?id=<?php echo $id ?>" title="journal.php?id=<?php echo $id ?>" class="inactive" href="journal.php?id=<?php
    	        echo $id ?>" alt="<?php echo $subject?>"> <?php echo $subject;?></a></p>
<?php	
			}
?>
		</div>
<?php	
		}
		
		public function header1($buttons)
		{
?>
		<div id='Content'>
			<div id='title'>
    			<div id="titletext">
    				<p><h1><a href="index.php">RIPPED & FIT</a></h1></p>
   				</div>
			</div>
			<div id="navbar">	
<?php
				while(list($name, $url) = each($buttons))
				{
					$this-> DisplayButton($name, $url);
				}
?>		
			<div id="navbar1">
        		<a href="#">
<?php

				if($_SESSION['valid_user'])
				{
					echo $_SESSION['valid_user'];
				} else {
					echo "Log in";
				}
?>        	
				</a>
        	</div>
    	</div>
    	<div id="headerPhoto">
    		<img src="images/R&FTitle.png" width="100%">
    	</div>
<?php
		}
		
		public function DisplayButton($name,$url)
		{
?>		
		<div id="navbar1">
			<a href="<?php echo $url ?>" ><?php echo $name ?></a>
        </div>
<?php
		}
	
		public function footer()
		{
?>
		<div id='foot'>
			<div id="footlinks">
				<p><a href="change_form.php">Change password!!!</a></p>
				<p><a href="forgot_form.php">Forgot your password?</a></p>
				<p><a href="termofservice.php">Terms of service</a></p>
<?php    
   			if(!$_SESSION['valid_user'])
			{
?>
				<p><a href="index.php">Logout</a></p>	
           	</div>	
		</div>
	</div>
<?php
			} else {
?>
			<p><a href="logout.php">Logout</a></p>	
			</div>	
		</div>
	</div>
<?php	
			}
		}
	
		public function login_form()
		{
?>
		<p><a href="register_form.php">Become a member to add comments!!!</a></p>
		<form method="post" action="login2.php">
			<table>
				<tr>
					<td colspan="2"><strong>Members log in here:</strong></td>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username"/></td>
				</tr>
				<tr>
					<td>Password:</td>
					<td><input type="password" name="passwd"/></td>
				</tr>
			
				<tr>
					<td colspan="2">
					<input type="submit" value="Log in"/></td>
				</tr>
			
				<tr>
					<td colspan="2"><a href="logout.php">Logout</a></td>
				</tr>
			</table>
		</form>
<?php
		}
	
		function display_registration_form()
		{
?>
		<form method="post" action="register_new.php">
			<table>	
				<tr>
					<td>Username: (max 16 characters)</td>
					<td><input type="text" name="username" size="16" maxlength="16" /></td>
				</tr>
				<tr>
					<td>Password:(between 6 and 16 characters)</td>
					<td><input type="password" name="passwd" size="16" maxlength="16"/></td>
				</tr>
				<tr>
					<td>Confirm password:</td>
					<td><input type="password" name="passwd2" size="16" maxlength="16"/></td>
				</tr>
				<tr>
					<td>Email address:</td>
					<td><input type="text" name="email" size="30" maxlength="100"/></td>
				</tr>
				<tr>
					<td></td>
					<td><input type="checkbox" name="terms" value="Yes"/>I agree to<a href="termofservice.php">terms of service</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" align="center"><input type="submit" value="Register"/></td>
				</tr>
			</table>
		</form>
<?php	
		}
	
		function forgot_form()
		{
?>
		<h1>Forgot your password?</h1>
	<form method="post" action="forgot_pass.php"/>
		<table>
			<tr>
				<td>Username:</td><td><input type="text" name="username" size="30" maxlength="100"/></td>
			</tr>
			<tr>
				<td>E-mail:</td><td><input type="text" name="email" size="30" maxlength="100"/></td>
			</tr>
			<tr>
				<td><input type="submit" value="Retrieve"/></td>
			</tr>
		</table>
	</form>
<?php
		}
		
		function display_change_form()
		{
?>
		<h1>Change Password</h1>
		<form method="post" action="change_pass.php"/>
			<table>
				<tr>
					<td>Username:</td>
					<td><input type="text" name="username" size="30" maxlength="100"/></td>
				</tr>
				<tr>
					<td>Old password:</td>
					<td><input type="password" name="old_password" size="30" maxlength="100"/></td>
				</tr>
				<tr>
					<td>New password:</td>
					<td><input type="password" name="new_password" size="30" maxlength="100"/></td>
				</tr>
				<tr>
				<tr>
					<td>Re-type new:</td>
					<td><input type="password" name="new_password2" size="30" maxlength="100"/></td>
					<td>Re-type new password to confirm it!</td>
				</tr>
				<tr>
					<td><input type="submit" value="Submit new password"/></td>
				</tr>
			</table>
		</form>	
<?php
		}
	
		function excercise_form()
		{
?>
		<h1>Add new excercise!!!</h1>
		<form method="post" action="excerciseEntryProcess.php">
			<table>
				<tr>
					<td>Subject:</td>
					<td><input type="text" name="subject" size="30" maxlength="30"/></td>
				</tr>
				<tr>
					<td>Description 1:</td>
					<td><TEXTAREA name="entry1" rows="5" cols="20" /></TEXTAREA></td>
				</tr>
				<tr>
					<td>Photo 1:</td>
					<td><input type="text" name="photo1" size="40" maxlength="40"/></td>
				</tr>
				<tr>
					<td>Description 2:</td>
					<td><TEXTAREA name="entry2" rows="5" cols="20" /></TEXTAREA></td>
				</tr>
				<tr>
					<td>Photo 2:</td>
					<td><input type="text" name="photo2" size="40" maxlength="40"/></td>
				</tr>
				<tr>
					<td><select name="scenery">
						<option value="#">Select scenery!!!</option>
						<option value="portrait">Portrait</option>
						<option value="landscape">Landscape</option>
					</select></td>
				</tr>
				<tr>
					<td><input type="submit" value="ENTER!!!"/>
				</tr>
			</table>
		</form>
<?php
		}
	}
	ob_end_clean();
?>