<?php
	ob_start();
 	   require('db_fns.php');
		require('post_topic.php');
		require('content_display.php');
		require('user_auth_fns.php');
		require('varadmin.php');
	ob_end_clean();
?>