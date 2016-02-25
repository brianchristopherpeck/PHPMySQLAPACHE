<?php
    require_once('require.php');
		session_start();

		

		
		
		include('db_fns.php');
		
		if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
		{
    		die("Invalid ID specified.");
		}

		$id = (int)$_GET['id'];
		 
		 
		 $query = "SELECT id FROM exportrait WHERE id='".$id."' LIMIT 1";
					$result = mysqli_query($conn, $query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$subject=$row['subject'];
						$id=$row['id'];
					}
		
		class archivePage extends Page {
			
			public function Display()
			{
				echo "<html>\n<head>\n";
				$this->DisplayDocHeader();
				$this-> DisplayStyles();
				$this-> DisplayTitle();
				$this-> DisplayKeywords();
				$this-> DisplayDescription();
				$this-> DisplayGoogle();
				echo "</head>\n<body>\n";
				$this->header1($this->buttons);
				$this->main();
				$this->left();
				$this -> footer();
				echo "</body>\n</html>\n";
			}
			
			public function DisplayKeywords()
			{
				
				include('db_fns.php');	
				if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
				{
    				die("Invalid ID specified.");
				}
				
				$id = (int)$_GET['id'];
		
				$query = "SELECT * FROM exportrait WHERE id='".$id."' LIMIT 1";
					$result = mysqli_query($conn,$query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$subject1=$row['subject'];
						echo "<meta name=\"keywords\"
						content=\""  .$subject1. "\"/>";
					}
			}
				
			public function DisplayDescription()
			{
				include('db_fns.php');
				
				if (!isset($_GET['id']) || !is_numeric($_GET['id']))
				{
    				die("Invalid ID specified.");
				}

				$id = (int)$_GET['id'];
		
				$query = "SELECT * FROM exportrait WHERE id='".$id."' LIMIT 1";
					$result = mysqli_query($conn, $query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$subject1=$row['subject'];
						echo "<meta name=\"description\"
						content=\"".$subject1."\"/>";
					}
			}
				
			public function DisplayStyles()
			{
?>
				<link rel='stylesheet' href='style.css'/>
<?php
				include('db_fns.php');
					
				if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
				{
    				die("Invalid CSS specified.");
				}

				$id = (int)$_GET['id'];
		
				$query = "SELECT * FROM exportrait WHERE id='".$id."' LIMIT 1";
					$result = mysqli_query($conn,$query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$scenery=$row['scenery'];
						
						if($scenery=='portrait')
						{
?>
<style type="text/css">

/* Portrait */
	#exentry {
		width:596px;
		height:900px;
	}
	
	#exentry1 {
		float:left;
		width:298px;
		height:400px;
		
	}
	
	#exphoto1 {
		float:left;
		width:198px;
		height:400px;
	}
	
	#exphoto2 {
		float:left;
		width:198px;
		height:400px;
	}

	#exentry2 {
		float:left;
		width:298px;
		height:400px;
	}
	
	</style>
<?php
						} else if ($scenery=='landscape') {
?>
<style type="text/css">

/* Landscape */
	#exentry {
		width:596px;
		height:900px;
	}
	
	#exentry1 {
		float:left;
		width:196px;
		height:100px;
		
	}
	
	#exphoto1 {
		float:left;
		width:296px;
		height:400px;
	}
	
	#exphoto2 {
		float:left;
		width:296px;
		height:400px;
	}

	#exentry2 {
		float:left;
		width:196px;
		height:100px;
	}
	</style>
<?php
						}
					}
			}	
				
			public function main()
			{
?>
				<div id='main'>
					<div id='exentry'>
<?php
				include('db_fns.php');
					
				if (!isset($_GET['id']) || !is_numeric($_GET['id'])) 
				{
    				die("Invalid ID specified.");
				}

				$id = (int)$_GET['id'];
			
				
				$query = "SELECT subject, entry1, photo1, photo2, entry2 FROM exportrait where id='".$id."' LIMIT 1";
				$result = mysqli_query($conn,$query); 
				while($row = mysqli_fetch_array($result)) 
				{
					$subject3=($row['subject']);
					$entry1=($row['entry1']);
					$photo1=($row['photo1']);
					$photo2=($row['photo2']);
					$entry2=($row['entry2']);
?>					
					
					<p><h1><?php echo $subject3; ?></h1></p>
					<div id='exentry1'><p><?php echo $entry1; ?></p></div>
					<div id='exphoto1'><p><img src='images/<?php echo $photo1; ?> '/></p></div>
					<div id='exentry2'><p><?php echo $entry2; ?></p></div>
					<div id='exphoto2'><p><img src='images/<?php echo $photo2; ?> '/></p></div>
					
<?php
				}
?>
				</div>
				<div id="archivelist">
<?php

		
				include('db_fns.php');
				$query = "SELECT id, subject FROM exportrait ORDER BY id";
				$result = mysqli_query($conn,$query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$subject2 = stripslashes($row['subject']);
						$id2=($row['id']);		
				
?>			
						<p><a id="archive.php?id=<?php echo $id2 ?>" alt="<?php echo $id2 ?>"title="archive.php?id=<?php echo $id2 ?> <?php echo 						 ($id2 ==$id) ? ' class="active"' : ''; ?>"href="archive.php?id=<?php echo $id2 ?>"> <?php echo $subject2 ?></a></p>
<?php
					}
?>
				</div>
				</div>
<?php
			}

		}
		
		$archivepage= new archivePage;
		$archivepage->Display();
		
		
?>
