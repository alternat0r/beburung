<?php
	date_default_timezone_set('Asia/Kuala_Lumpur'); 
	
	// check new updates on every $cycle_time time 
	$cycle_time = "7"; // in minutes
	$check_loop_limit = 5000;
	
	for ($x=1; $x<$check_loop_limit; $x++)
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
?>
