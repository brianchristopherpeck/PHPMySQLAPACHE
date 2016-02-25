<?php
   function generatePassword($length=9, $strength=0) {
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

	
	$new_password=generatePassword();
	echo $new_password;
?>
