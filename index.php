<?php
	//error_reporting(0);
	//echo "<META HTTP-EQUIV=\"refresh\" CONTENT=\"900\">";
	date_default_timezone_set('Asia/Kuala_Lumpur'); 
	
	$cycle_time = "7"; // in minutes
	
	for ($x=1; $x<5000; $x++)
	{
		$today = date("Y-m-d H:i:s");
		echo "--------------------------------------------------------------!\n";

		require ('autobot1.php');

		echo "--------------------------------------------------------------!\n";
		echo colorize("[*] Masa: ".$today."\n", "YELLOW");
		echo colorize("[*][".$x."] Waiting (".$cycle_time." minutes): ", "YELLOW");
		for($i=1; $i<$cycle_time+1; $i++) {
			echo $i.", ";
			sleep(60);
		}
		echo "\n";
	}	
	/*$page = $_SERVER['PHP_SELF'];
	$sec = "5";
	header("Refresh: $sec; url=$page");*/
?>
