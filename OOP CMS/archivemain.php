<?php
   require_once('require.php');
		session_start();

		

		
		
		class archiveMain extends Page {
			
			public $description = "Excercise Manual - Choose an excercise and get started on your path to fitness!!!";
			
			public function main()
			{
?>
			<div id="main">
				<div id="archivelist">
					<p><h1>Excercise Manual</h1></p>
					<p>Pick an excercise to view its proper technique!!!</p>
<?php
				global $subject;
				include('db_fns.php');
				$query = "SELECT id, subject FROM exportrait ORDER BY id";
				$result = mysqli_query($conn,$query); 
					while($row = mysqli_fetch_array($result)) 
					{
						$subject2 = stripslashes($row['subject']);
						$id2=($row['id']);		
				
?>			
						<p><a id="archive.php?id=<?php echo $id2 ?>" alt="<?php echo $id2 ?>" title="archive.php?id=<?php echo $id2 ?> <?php 		 						echo  ($id2 ==$id) ? ' class="active"' : ''; ?>" href="archive.php?id=<?php echo $id2 ?>"> <?php echo $subject2 ?></a>
                        </p>
<?php
					}
?>
				</div>
			</div>
<?php
			}
		}
	
	$archivemain= new archiveMain;
	$archivemain->Display();
	
	
?>
