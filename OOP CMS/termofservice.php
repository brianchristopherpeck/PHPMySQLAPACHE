<?php
    require_once('require.php');
		session_start();

		

		
		
		class termsPage extends Page
	{
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
			$this -> footer();
			echo "</body>\n</html>\n";
		}

	function main()
	{
?>
<div id='main'>
<h1><strong>TERMS OF SERVICE</strong></h1>
<h2>The following rules govern the use by you of rippedandfit.com. 
By accessing this site, you agree to abide by these rules and any modifications thereto.</h2>
<p>The words website, site and forum should be considered the same for the purposes of understanding this disclaimer. </p>
<p>If you do not completely understand and agree with the conditions of this disclaimer, then you should not read one word on this forum and leave this forum immediately.</p>
<p>This forum may or may not reflect the views of the writers in their individual or corporate capacity. The views on the forum do not represent the views of rippedandfit.com, and is not sponsored or endorsed by rippedandfit.com.</p>
<p>In no way should any of the information, whether written or constructed by one of the writers or the commenters on this forum, be construed as professional advice. Every person or company's situation is completely different and therefore you are hereby advised to consult with a professional before making any decision.</p>
<p>All information on this forum is provided "as is", with no guarantee of completeness, accuracy, timeliness or of the results obtained from the use of this information, and without warranty of any kind, express or implied, including, but not limited to warranties of performance, merchantability and fitness for a particular purpose. In no event will rippedandfit.com, its related partnerships, agents or employees thereof be liable to you or anyone else for any decision made or action taken in reliance on the information in this forum or for any consequential, special or similar damages, even if advised of the possibility of such damages.</p>
<p>rippedandfit.com reserves the right to remove any and all comments that do not comply with the Forum Comment Guidelines contained below. These include comments that use profanity, make personal attacks, or contain other inappropriate comments or material. Finally, we will take steps to block users who violate any of our posting standards, terms of use or any other policies governing this site.</p>
<p>rippedandfit.com makes no warranties of any kind with regard to the contents of this site or to any comments posted by third parties, including without limitation warranties of title, non-infringement, or implied warranties of merchantability or fitness for a particular purpose. rippedandfit.com does not warrant that any information is complete or accurate or that any information or links provided are free of rogue programming. You understand and acknowledge that you use and/or rely on any information obtained through the blog at your own risk.</p>
<p>By using this forum, you hereby release and waive any and all claims against rippedandfit.com, its Sections, Branches, directors, officers, employees, members and agents, arising from or in connection with your use of this site. You also agree to defend, indemnify, and hold harmless rippedandfit from and.com against any and all claims, including costs and reasonable attorneys’ fees, arising from or in connection with your use of the forum or your failure to abide by applicable law.</p>
<p>Forum Comment Guidelines</p>
<p>We welcome your participation in blog comment threads. In order to keep the experience a positive one for all of our users, we ask that you follow the rules outlined below. By submitting comments to this forum, you are consenting to the following rules:</p>
<p>1. You agree that you are fully responsible for the content that you post. You may not post content that is libelous, defamatory, obscene, abusive, that violates a third party’s right to privacy, that otherwise violates any applicable local, state, national or international law, or that is otherwise inappropriate. Furthermore, you may not post content that degrades others on the basis of gender, race, class, ethnicity, national origin, religion, sexual preference, disability or other classification. Language intended to intimidate or to incite violence will not be tolerated. In addition, by posting material on the blog comments, you represent that you have the legal right to reproduce, adapt, display, and distribute this material to others. rippedandfit.com. will not be held responsible for posted information that may infringe on a third party’s copyright, trademark, or other intellectual property rights.</p>
<p>2. You understand and agree that rippedandfit.com may modify the content of your comments. rippedandfit.com may monitor user-generated content as it chooses and reserves the right to remove, edit or otherwise alter content that it deems inappropriate for any reason. </p>
<p>3. You understand and agree that the forum is to be used only for non-commercial purposes. This blog prohibits any actions to solicit funds, promote commercial entities or otherwise engage in commercial activity through the blog comment function.</p>
</div>
<?php
	}
function left() {
?>
<div id='left'>
<?php	
if($_SESSION['valid_user']){
	echo '<p><a id="index" title="index" class="inactive" href="member.php" alt="HOME">Member</a>';
	}else{
		echo '<p><a id="index" title="index" class="inactive" href="index.php" alt="HOME">Home</a>';
	}
	

		global $id;
		include('db_fns.php');
		$query = "SELECT id, subject FROM forum ORDER BY timestamp";
		$result = mysqli_query($conn, $query); 
		while($row = mysqli_fetch_array($result)) {
			$subject = stripslashes($row['subject']);		
			$id2 = ($row['id']);
?>			
	<p><a id="journal.php?id=<?php echo $id2 ?>" alt="<?php echo $subject ?>"title="journal.php?id=<?php echo $id2 ?>" <?php echo  ($id2 ==$id) ? ' class="active"' : ''; ?>" href="journal.php?id=<?php echo $id2 ?>"> <?php echo $subject ?></a></p>
	
<?php
	}
?>
</div>
<?php	
}		
		
	}
	$terms = new termsPage;
	$terms->Display();
	
	
?>

