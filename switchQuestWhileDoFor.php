<?php
	// switch
	$mood = "Joyous";
	switch($mood) 
	{
		case "Happy":
			echo "I'm really happy";
			break;
		case "Sad":
			echo "I'm not " .$mood. ", I'm sad";
			break;
		case "Joyous":
			echo "I'm freaking " .$mood. "!<br/>";
			break;
		default:
			echo "Failed";
			break;
	}

	// ? operator
	$attitude = "Cocky";
	$texty = ($mood == "Happy") ? "I'm in a great mood!" : "I'm feeling " .$mood."!<br/>";
	echo $texty;

	// While
	$counter = 1;
	while ($counter <= 12)
	{
		echo $counter. ".) I can't sleep the clowns might eat me <br/>";
		$counter ++;
	}
	echo "I will always stay awake!<br/>";


	// do while
	$num = 1;
	do {
		echo "Tonight, tonight, it's on, tonight. I don't want your boring life!<br/>";
		$num ++;
	} while (($num > 1) && ($num < 40));

	// for
	$stitch = "Ohana means family";
	for($i = 1; $i <= strlen($stitch); $i++)
	{
		echo $i.".) Ohana means family.<br/>";
	}

	// array
	$characters = array 
	(
		"Protagonist" => "Wade",
		"Love Interest" => "Zoe",
		"Antagonist" => "Dixie" 
	);

	foreach ($characters as $c => $v) {
			echo $v. " " .$c."<br/>";
	}
?>